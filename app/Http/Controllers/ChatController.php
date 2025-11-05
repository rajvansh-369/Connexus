<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('chat', ['user' => $user]);
    }
   
   
    public function testChat()
    {
        $user = Auth::user();

       
        return view('pages.chat', ['user' => $user]);
    }
}
