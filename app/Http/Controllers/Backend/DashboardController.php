<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Termwind\Components\Dd;

use function PHPUnit\Framework\fileExists;

class DashboardController extends Controller
{

    public function admin_login()
    {
        return view('backend.layouts.admin_login');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
    public function login(Request $request)
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
            return redirect()->route('dashboard');
        } else {
            // dd($credentials);
            return redirect()->back();
        }

        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->onlyInput('email');

    }
    public function dashboard()
    {
        return view('backend.master');
    }

    public function order()
    {
        return view('backend.layouts.order_list');
    }
    public function user_list()
    {
        $users = User::where('role_id',2) -> get();
        // dd($user);
        return view('backend.layouts.user_list',compact('users'));
    }

    public function user_edit($id)
    {
        $user = User::find($id);
        // $user = User::where('id',$id)->first();
        // dd($user);
        return view('backend.layouts.user_edit',compact('user'));
    }

    public function user_update(Request $req, $id)
    {
        $user = User::find($id);
        $des = public_path('\\uploads\\profile\\'.$user -> image);
        // dd($des);
        $filename = '';
        if($req->hasFile('image')){
            if(File::exists($des)){
                File::delete($des);
            }
            $file = $req->file('image');
            if($file->isValid()){
                $filename = date('Ymdhms').rand(1,1000).'.'. $file->getClientOriginalExtension();
                $file->storeAs('profile',$filename);
            }
        }

        $user->update([
            'name' => $req -> name,
            'email' => $req -> email,
            'address' => $req -> address,
            'phone' => $req -> phone,
            'image' => $filename

        ]);
        return redirect() -> route('user_list');
    }
    public function user_delete($id)
    {
        $user = User::find($id);
        $des = public_path('\\uploads\\profile\\'.$user -> image);
        // dd($des);
        $filename = '';
        
            if(File::exists($des)){
                File::delete($des);
            }
            $user -> delete();
        return redirect() -> route('user_list');
    }
}
