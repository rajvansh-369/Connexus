import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import './bootstrap'; // sets XSRF header via cookies

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'wvvqtf2yh8o8sjglmvku',
    wsHost: window.location.hostname,
    wsPort: 9000,
    cluster: 'mt1',  // Keep this - Reverb doesn't validate it
    forceTLS: false,
    disableStats: true,
    enabledTransports: ['ws', 'wss'],
    authEndpoint: '/broadcasting/auth', // ensure this matches your app base path [web:40]
    auth: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    },
});

// Connection debugging
window.Echo.connector.pusher.connection.bind('connected', () => {
    console.log('✅ WebSocket connected');
});

window.Echo.connector.pusher.connection.bind('error', (err) => {
    console.error('❌ WebSocket connection error:', err);
});

// Event listener
console.log('Subscribing to test-channel...');
// window.Echo.channel('test-channel')
//     .listen('.TestBroadcast', e => {
//         console.log('Received message:', e.message);
//     });

