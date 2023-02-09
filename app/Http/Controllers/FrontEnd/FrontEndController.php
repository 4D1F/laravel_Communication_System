<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FrontEndController extends Controller
{
    

    public function welcome()
    {
        return view('welcome');
    }

    public function registration(Request $request)
    {
        $filename = '';
        if($request->hasFile('image')){
            $file = $request->file('image');
            if($file->isValid()){
                $filename = date('Ymdhms').rand(1,1000).'.'. $file->getClientOriginalExtension();
                $file->storeAs('profile',$filename);
            }
        }        
        
        User::create([

            'name' => $request -> name,
            'email' => $request -> email,
            'address' => $request -> address,
            'phone' => $request -> phone,
            'image' => $filename,
            'password' => Hash::make($request -> password)

        ]);
        return redirect() -> back();
    }

    
    public function user_create()
    {
        return view('backend.layouts.user_create');
    }

    
//     public function user($id)
//     {
//         return $id;
//     }
}
