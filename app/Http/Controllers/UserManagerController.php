<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserManagerController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminOnly');
    }

    public function index(){
        $users = User::all();
        return view('usersManager.index',compact('users'));
    }

    public function adminUpgrade(Request $request){

        $request->validate([
           'id' => 'required',
        ]);
        if(is_numeric($request->id)){
            $user = User::find($request->id);
            $user->role = '0';
            $user->update();
            return redirect()->back()->with('message',['icon'=>'success','title'=> $user->name.' is upgrade to admin']);
        }
        return 'mar tal';
    }

    public function banuser(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        if(is_numeric($request->id)){
            $user = User::find($request->id);
            $user->isBaned = '1';
            $user->update();
            return redirect()->back()->with('message',['icon'=>'error','title'=> $user->name.' is Banned from admin']);
        }
        return 'mar tal';
    }

    public function unBan(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        if(is_numeric($request->id)){
            $user = User::find($request->id);

            if($user->isBaned == 1){
                $user->isBaned = '0';
                $user->update();
                return redirect()->back()->with('message',['icon'=>'success','title'=> $user->name.' is Unban from admin']);
            }
        }
        return 'mar tal';
    }

    public function changePassword(Request $request){

        $validator = Validator::make($request->all(),[
           'password' => 'required|string'
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()]);
        }
        $user = User::find($request->id);
        $user->password = Hash::make($request->password);
        $user->update();
        return [ 'statusCode'=>200,'success'=>'Password Successfully Changed!!'];
    }
}
