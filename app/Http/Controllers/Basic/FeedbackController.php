<?php

namespace App\Http\Controllers\Basic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Basic\Mail\SendMailRequest;
use App\Mail\FeedbackMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function sendMail(SendMailRequest $request){
        $data=$request->validated();

        Mail::to('sharutyunyan777@gmail.com')->send(new FeedbackMail($data));

    }
}
