<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function name(){

        return view('profile.changeNameAndEmail');
    }

    public function showInfo(){

        return view('profile.infoprofile');
    }


    public function showPassword(){

        return view('profile.showPassword');
    }

    public function showPhoto(){

        return view('profile.showPhoto');
    }

    public function updateAll(Request $request,$name){
        $request->validate([
            'name' => 'required|min:4|max:20'
        ]);

        $user = User::find(Auth::id());
        $user->$name = $request->name;
        $user->update();
        return redirect()->back()->with('toast',['icon'=>'success','title'=>$request->name.' Successfully Updated']);
    }
//    public function updateName(Request  $request){
//        $request->validate([
//            'name' => 'required|min:4|max:20'
//        ]);
//
//        $user = User::find(Auth::id());
//        $user->name = $request->name;
//        $user->update();
//        return redirect()->route('home');
//    }
//    public function updateEmail(Request  $request){
//        $request->validate([
//            'email' => 'required|min:4|max:30'
//        ]);
//
//        $user = User::find(Auth::id());
//        $user->email = $request->email;
//        $user->update();
//        return redirect()->back();
//    }

    public function updatePassword(Request  $request){
        $request->validate([
           'old' => ['required',new MatchOldPassword()],
            'new' => ['required'],
            'Cnew'=>['same:new'],
        ]);
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new);
        $user->update();
        Auth::logout($user);
        return redirect()->route('login')->with('toast',['icon'=>'success','title'=>'Password Successfully Updated']);
    }

    public function updatePhoto(Request $request){
        $request->validate([
           'photo' => 'required|mimetypes:image/jpg,image/jpeg,image/png|file|max:2500'
        ]);

       $file = $request->file('photo');
       $dir = 'public/profile/';
       $newName = uniqid().'_profile_'.$file->getClientOriginalName();
       Storage::putFileAs($dir,$file,$newName);


       $user = User::find(Auth::id());
       $user->photo = $newName;
       $user->update();

//        $path = 'storage/profile/';
//        File::delete($path.$user->photo);
//
//        foreach ($photos as $photo){
//            if($photo != '.' && $photo != '..' && $photo != 'user.png' && $photo != $newName){
//                File::delete(public_path('storage/profile/'.$photo));
//
//            }
//        }
        return redirect()->back()->with('toast',['icon'=>'success','title'=>'Photo Successfully Updated']);


    }

    public function updateInfo(Request $request){
        $request->validate([
           'phone' => 'required|min:11|max:11',
           'address'=>'required|min:10|max:100'
        ]);
        $user = User::find(Auth::user()->id);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        return redirect()->back()->with('toast',['icon'=>'success','title'=>'Phone And Address Successfully Updated']);
    }
}
