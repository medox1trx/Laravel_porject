<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.index');
    }

    public function fetchMessages()
    {
        $messages = Message::with('user')->orderBy('created_at', 'asc')->get();
        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $message = Auth::user()->messages()->create([
            'content' => $request->content,
        ]);

        return response()->json(['status' => 'Message Sent!', 'message' => $message->load('user')]);
    }
}
