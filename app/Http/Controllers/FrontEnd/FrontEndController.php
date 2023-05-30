<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\ChMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\File;

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
                $file->storeAs('uploads/profile', $filename);
                $file->storeAs('storage/users-avatar', $filename);
            }
        }
        else{
            $filename = 'dummy.png';
        }
        
        try {

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'image' => $filename,
                'avatar' => $filename,
                'password' => Hash::make($request->password)

            ]);
            return redirect()->route('user_login')->with('success','Registration Successful, Please Login to Continue');
        } catch (Exception $e) {
            // $error = $e -> getMessage();
            return redirect()->back()->with('error', 'Email invalid');
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

    public function user_profile()
    {
        $user = User::find(Auth::user()->id);
        return view('frontend.layouts.user_profile', compact('user'));
    }

    public function user_profile_update(Request $req, $id)
    {
        $user = User::find($id);
        $des = public_path('uploads\\profile\\' . $user->image);
        $des2 = public_path('storage\\users-avatar\\' . $user->image);
        // dd($des);
        $filename = $user-> image;
        if ($req->hasFile('image')) {
            if (File::exists($des)) {
                if($user->image != 'dummy.png' || $user->avatar != 'avatar.png'){

                    File::delete($des);
                    File::delete($des2);
                }
            }
            $file = $req->file('image');
            if ($file->isValid()) {
                $filename = date('Ymdhms') . rand(1, 1000) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('uploads/profile', $filename);
                $file->storeAs('storage/users-avatar', $filename);
            }
        }

        $user->update([
            'name' => $req->name,
            'email' => $req->email,
            'address' => $req->address,
            'phone' => $req->phone,
            'image' => $filename,
            'avatar' => $filename

        ]);
        
        return redirect()->route('user_profile')->with('success', 'Updated Successfully');
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
                return redirect()->route('welcome')->with('success','Login Successful');
            } else {
                return redirect() -> route('logout')->with('error','Login Failed');
            }
        } else {
            // dd($credentials);
            return redirect() -> back() ->with('error','Login Failed');
        }


        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->onlyInput('email'); 
    }

    public function user_dashboard()
    {
        $messages = ChMessage::where('from_id', Auth::user()->id)->orWhere('to_id', Auth::user()->id)->orderBy('ch_messages.created_at', 'desc')->take(50)->paginate(10);
        return view('frontend.layouts.dashboard',compact('messages'));
    }
}
