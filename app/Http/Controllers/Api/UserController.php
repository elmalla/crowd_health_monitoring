<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function udpatePassword (Request $request ){
        $user = auth()->user();
        if(!Hash::check($request->password, $user->password)){
            return response()->json(['message' => 'Your Currunt Password is incorrect']);
        }

        $valideDate = $request->validate([
            'password' => 'required',
            'new_password' => 'required|confirmed',
            'new_password_confirmation' => 'required',
        ]);
        $user->password = bcrypt($valideDate['new_password']);

        if($user->save()){
            return ['message' => 'password update successfully'];
        }else{
            // return response()->json(['message' => 'Some Error happened, Please Try again'], status:500);
            return response()->json(['message' => 'Some Error happened, Please Try again']);
        }
    }

    public function updateProfile (Request $request){
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.auth()->id()
        ]);

        if (auth()->user()->update($validateData)){
            return ['message' => 'Update successfuly'];
        }
        return response()->json(['message' => 'Please try agian later']);
    }

}
