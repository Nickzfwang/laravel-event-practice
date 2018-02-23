<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\SendMessage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class MessageController extends Controller
{
    public function sendMessage()
    {
        $username = 'Nick';
        $message = 'Laravel with pusher 3.0 test.';
        $user = [
            'id' => 10001,
            'username' => $username,
        ];
        event(new SendMessage($user, $message));
        return 'message sent';
    }

    public function getMessage()
    {
        $memberId = 10001;
        return view('push')->with(compact('memberId'));
    }
    public function getUserInfo()
    {
        $data = User::find(1)->first();
        return response()->json($data);
    }
}
