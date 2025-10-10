<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WebSocketServer extends Command
{
    protected $signature = 'websocket:serve {host=0.0.0.0} {port=6001}';
    protected $description = 'Run simple WebSocket server (pure PHP)';

    protected $clients = [];

    public function handle()
    {
        $host = $this->argument('host');
        $port = (int)$this->argument('port');

        $this->info("Starting WebSocket server on {$host}:{$port}");

        $sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_set_option($sock, SOL_SOCKET, SO_REUSEADDR, 1);
        socket_bind($sock, $host, $port);
        socket_listen($sock);

        $this->clients = [$sock];

        while (true) {
            $read = $this->clients;
            $write = $except = null;
            if (socket_select($read, $write, $except, NULL) <= 0) {
                continue;
            }

            foreach ($read as $r) {
                if ($r === $sock) {
                    $newsock = socket_accept($sock);
                    $this->clients[] = $newsock;
                    $this->info("New connection");
                } else {
                    $bytes = @socket_recv($r, $buffer, 2048, 0);
                    if ($bytes === 0 || $bytes === false) {
                        // disconnected
                        $this->disconnectClient($r);
                        continue;
                    }

                    // If this client hasn't completed handshake yet, buffer contains HTTP handshake
                    $clientIndex = array_search($r, $this->clients, true);
                    if ($this->isHandshake($buffer)) {
                        $this->doHandshake($buffer, $r);
                        $this->info("Handshake done with client #{$clientIndex}");
                    } else {
                        $data = $this->decodeMessage($buffer);
                        if ($data === null) continue;
                        $this->info("Received: {$data}");
                        // Broadcast to all other clients (except listening socket and sender)
                        foreach ($this->clients as $client) {
                            if ($client === $sock || $client === $r) continue;
                            $this->sendMessage($client, $data);
                        }
                    }
                }
            }
        }
    }

    protected function disconnectClient($client)
    {
        $idx = array_search($client, $this->clients, true);
        if ($idx !== false) {
            unset($this->clients[$idx]);
            socket_close($client);
            $this->info("Client disconnected (index {$idx})");
        }
    }

    protected function isHandshake($buffer)
    {
        return (strpos($buffer, "Sec-WebSocket-Key:") !== false);
    }

    protected function doHandshake($buffer, $client)
    {
        if (!preg_match("/Sec-WebSocket-Key: (.*)\r\n/", $buffer, $matches)) {
            return false;
        }
        $key = trim($matches[1]);
        $accept = base64_encode(sha1($key . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11', true));
        $upgrade = "HTTP/1.1 101 Switching Protocols\r\n" .
                   "Upgrade: websocket\r\n" .
                   "Connection: Upgrade\r\n" .
                   "Sec-WebSocket-Accept: $accept\r\n\r\n";
        socket_write($client, $upgrade, strlen($upgrade));
        return true;
    }

    // decode client -> server (clients send masked frames)
    protected function decodeMessage($data)
    {
        $bytes = ord($data[1]) & 127;
        $mask = '';
        $payloadOffset = 2;

        if ($bytes === 126) {
            $mask = substr($data, 4, 4);
            $payloadOffset = 8;
            $payloadLen = unpack('n', substr($data, 2, 2))[1];
            $payload = substr($data, $payloadOffset, $payloadLen);
        } elseif ($bytes === 127) {
            // not handling very large frames here
            $mask = substr($data, 10, 4);
            $payloadOffset = 14;
            $payloadLen = unpack('J', substr($data, 2, 8))[1] ?? 0;
            $payload = substr($data, $payloadOffset, $payloadLen);
        } else {
            $mask = substr($data, 2, 4);
            $payload = substr($data, 6);
        }

        $unmasked = '';
        for ($i = 0, $len = strlen($payload); $i < $len; $i++) {
            $unmasked .= $payload[$i] ^ $mask[$i % 4];
        }
        return $unmasked;
    }

    // send server -> client (server frames are not masked)
    protected function sendMessage($client, $msg)
    {
        $payload = $msg;
        $length = strlen($payload);

        if ($length <= 125) {
            $header = pack('C*', 0x81, $length);
        } elseif ($length <= 65535) {
            $header = pack('C*', 0x81, 126) . pack('n', $length);
        } else {
            $header = pack('C*', 0x81, 127) . pack('J', $length);
        }

        socket_write($client, $header . $payload, strlen($header . $payload));
    }
}
