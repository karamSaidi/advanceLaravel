<?php

namespace App\Http\Controllers\Advance;

use App\User;
use App\Model\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\SendMailJob;
use App\Mail\TestMail;

class SendingMainBackgroundController extends Controller
{
    public function sendingMail()
    {
        $users = User::select('name', 'email')->chunk(50, function($data){
            // dd($data);
            dispatch(new SendMailJob($data));
        });

        return redirect()->route('home')->with('success', 'Email will send in background');

    }// end sendingMail


}// end controller
