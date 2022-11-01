<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password =Hash::make($request->password);

        if($user->save()){
          
          Auth::login($user);
          return response()->json($user,201);

        }else {
          return response()
                          ->json(
                                array(
                                      'code' => 404 ,
                                      'message' => "errror"
                                    )
                            );
        }


    }

    public function getUser(){
      if (Auth::user()==null){
      return response()
                      ->json(
                            array(
                                  'code' => 203 ,
                                  'message' => "try again to login"
                                )
                        );
     } else {
       $user = Auth::user();
       return response()
                       ->json(
                             array(
                                   'code' => 200 ,
                                   'message' => "there is "+$user->name+", on the sytem"
                                 )
                         );
     }
  }
}
