<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index(){
        return view("frontend.contact");
    }
    public function store(ContactRequest $request){
        $request->validated();
        $request->merge([
            "ip_address"=> $request->ip(),
        ]);
        $contact=Contact::create($request->all());
        
        if (!$contact){
            session::flash('error','contact us failed');
            return redirect()->back()->withInput();
        }
        session::flash('success','Your Msg created succsessfuly!');
        return redirect()->back();
    }
}
