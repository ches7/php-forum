<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
    
    // Show messages between two users
    public function show($user) {

        $messages = DB::table('messages')->where([
            ['sender_id', $user],
            ['recipient_id', auth()->id()]
        ])->orWhere([
            ['sender_id', auth()->id()],
            ['recipient_id', $user]
        ])->get();

        // echo("<script>console.log('PHP: " . $messages . "');</script>");

        Session::put('messages_url', request()->fullUrl());

        return view('messages.show', [
                    'messages' => $messages,
                    'user' => $user
                ]);
    }

    // Store Message Data
    public function store(Request $request, $user) {
        $formFields = $request->validate([
            'body' => 'required',
        ]);

        $formFields['sender_id'] = auth()->id();
        $formFields['recipient_id'] = $user;

        Message::create($formFields);
        
        if(session('messages_url')){
            return redirect(session('messages_url'));
        }
        return redirect('/')->with('message', 'Message created successfully!');
    }

}
