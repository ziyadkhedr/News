<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\settingRequest;
use App\Models\User;
use App\Utils\ImageMasnager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index(){
        $user = auth()->user();
        return view('frontend.dashboard.setting',compact('user'));
    }
    public function update(settingRequest $request){
        $request->validated();
        $user=User::findOrFail($request->user()->id);
        $user->update($request->except(['image']));
        ImageMasnager::uploadImages($request,null, $user);
        return redirect()->back()->with('success','Profile Updated Successfully!');
    }
    public function changePassword(request $request){
        $request->validate([
            'current_password'=>['required'],
            'password'=> ['required','confirmed'],
            'password_confirmation'=>['required'],
        ]);
        if(!Hash::check($request->current_password,auth()->user()->password)){
            Session::flash('error','currnet Password Incorrect');
            return redirect()->back();
        }
        $user = User::findOrFail($request->user()->id);
        $user->update(['password'=>Hash::make($request->password)]); 
            Session::flash('success','Password has changed successfully');
            return redirect()->back();
    }
}
