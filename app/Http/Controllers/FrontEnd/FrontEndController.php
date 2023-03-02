<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class FrontEndController extends Controller
{


    public function welcome()
    {
        return view('welcome');
    }

    public function registration(Request $request)
    {
        $filename = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $filename = date('Ymdhms') . rand(1, 1000) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('profile', $filename);
            }
        }
        
        try {

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'image' => $filename,
                'password' => Hash::make($request->password)

            ]);
            return redirect()->route('user_login');
        } catch (Exception $e) {
            // $error = $e -> getMessage();
            return redirect()->back()->with('error', 'Enail invalid');
        }
    }


    public function user_create()
    {
        return view('backend.layouts.user_create');
    }


    public function user_login()
    {
        return view('frontend.layouts.user_login');
    }

    public function signin(Request $request)
    {
        //  dd($request->all());
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'The email field must be filled' //This is the error message
        ]);

        if (Auth::attempt($credentials)) {
            // dd($credentials);
            $user = User::where('email', $request->email)->first();

            if ($user->role_id == 2) {
                return redirect()->route('welcome');
            } else {
                return redirect()->route('logout');
            }
        } else {
            // dd($credentials);
            return redirect()->back();
        }


        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->onlyInput('email'); 
    }

    public function user_dashboard()
    {
        return view('frontend.master');
    }
}
