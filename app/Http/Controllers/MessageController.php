<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
    
    // Show messages between two users
    public function show($user) {

        // All users
        $messagesSent = DB::table('messages')->where([
            ['sender_id', auth()->id()]
        ])->get();
        $messagesRecieved = DB::table('messages')->where([
            ['recipient_id', auth()->id()]
        ])->get();

        $userIds = array();

        foreach ($messagesSent as $message){
           $userIds[] = $message->recipient_id;
        };
        foreach ($messagesRecieved as $message){
            $userIds[] = $message->sender_id;
        };

        $userIds = array_unique($userIds);

        $users = DB::table('users')->select('id', 'name')->whereIn(
            'id', $userIds
        )->get();

        // Messages between two users
        $messages = DB::table('messages')->where([
            ['sender_id', $user],
            ['recipient_id', auth()->id()]
        ])->orWhere([
            ['sender_id', auth()->id()],
            ['recipient_id', $user]
        ])->get();

        $fullUser = DB::table('users')->where([
            ['id', $user],
        ])->get();

        echo("<script>console.log('PHP: " . $fullUser . "');</script>");

        Session::put('messages_url', request()->fullUrl());

        return view('messages.show', [
                    'messages' => $messages,
                    'user_id' => $fullUser[0]->id,
                    'user_name' => $fullUser[0]->name,
                    'users' => $users
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
