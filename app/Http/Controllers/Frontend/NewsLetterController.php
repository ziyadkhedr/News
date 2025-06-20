<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Frontend\NewsSubscriber;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class NewsLetterController extends Controller
{
    public function store(Request $request){
        $request->validate([
            "email"=>['required','email','unique:newsletters,email'],
        ]);
        $newslatter=Newsletter::create([
            'email'=> $request->email,
        ]);
        if(!$newslatter){
            Session::flash('error','sorry trt again latter');
            return redirect()->back();
        }
        Mail::to(request()->email)->send(new NewsSubscriber());
        session::flash('success','Thanks for subscribe!');
        return redirect()->back();
    }
}
