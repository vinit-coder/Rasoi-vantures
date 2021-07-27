<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Api\V1\Requests\StoreUserRequest;

class RegisterApiController extends Controller
{
    /**
     * Register new Clients
     *
     * @return \Illuminate\Http\Response
     */
    public function register(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        

        if(!null==($request->file('image')))
        {

           $user->addMedia($request->file('image'))
              ->toMediaCollection('images');

              $user->image=$user->getMedia('images')->first()->getUrl();
 
        }

         

        $accessToken = $user->createToken('authToken')->accessToken;
            
        return response(['user'=>$user,'access_token'=>$accessToken,'user-ip',$request->ip(),'file'=>$request->all()]);
    }


    /**
     *  User/Client can ligin .
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //
            $validatedData     =  $request->validate([
             
            'email'=>'email|required',
            'password'=>'required'
        ]);

            if(!auth()->attempt($validatedData))
            {
                return response(['message'=>'invalid credencials']);
            }

            $accessToken  = auth()->user()->createToken('authToken')->accessToken;

            return response(['user'=>auth()->user(),'media'=> auth()->user()->getMedia(),'access_token'=>$accessToken

            ]);



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

  
}
