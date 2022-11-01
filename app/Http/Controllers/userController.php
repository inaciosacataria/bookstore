<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Auth;

class userController extends Controller
{
    public function register(Request $request){
       $user = new User;
       $user->name = $request->name;
       $user->email = $request->email;
       $user->role = $request->role;
       $user->password =Hash::make($request->password);

       if($user->save()){
          return response()->json($user,201);
       }else{
          return response()
                          ->json(
                                array(
                                      'code' => 404 ,
                                      'message' => "Error to creating user, try again"
                                    )
                            );
       }
    }

    public function getUser(){

     $users = DB::table('users')->get();
      return response()->json($users,200);
  }

}
