<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ChFavorite;
use App\Models\ChMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Termwind\Components\Dd;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use function PHPUnit\Framework\fileExists;

class DashboardController extends Controller
{

    public function admin_login()
    {
        return view('backend.layouts.admin_login');
    }

    public function logout(Request $request)
    {
        if (Auth::user()->role_id == 1) {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('admin_login')->with('warning', 'Logged out Successfully');
        }

        if (Auth::user()->role_id == 2) {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('user_login')->with('warning', 'Logged out Successfully');;
        }
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
            $user = User::where('email', $request->email)->first();

            if (Auth::user()->role_id == 1) {

                return redirect()->route('welcome')->with('success', 'Login Successful');
            } else {
                return redirect()->route('logout')->with('warning', 'Login Failed');
            }
        } else {
            // dd($credentials);
            return redirect()->back()->with('error', 'Login Failed');
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
        $users = User::where('role_id', 2)->get();
        // dd($user);
        return view('backend.layouts.user_list', compact('users'));
    }

    public function user_edit($id)
    {
        $user = User::find($id);
        $user = User::where('id', $id)->first();
        // dd($user);
        return view('backend.layouts.user_edit', compact('user'));
    }

    public function user_update(Request $req, $id)
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
        
        return redirect()->route('user_list');
    }


    public function user_delete($id)
    {
        $user = User::find($id);
        $des = public_path('uploads\\profile\\' . $user->image);
        $des2 = public_path('storage\\users-avatar\\' . $user->image);

        // dd($des);
        // $filename = '';
        
        if (File::exists($des)) {
            if($user->image != 'dummy.png' || $user->avatar != 'avatar.png'){

                File::delete($des);
                File::delete($des2);
            }
        }
        $user->delete();
        $user_msg = ChMessage::where('from_id',$id)->orwhere('to_id',$id)->get()->delete();
        $user_fav = ChFavorite::where('favorite_id',$id)->orwhere('user_id',$id)->get()->delete();
        $user_msg->delete();
        $user_fav->delete();
        // dd($user_msg, $user_fav);
        return redirect()->route('user_list');
    }

    public function messages()
    {
        // $users = User::find(1);
        // dd($users->test);

        $users = User::all();
        $messages = ChMessage::all();
        return view('backend.layouts.messages', compact('messages', 'users'));
    }

    public function message_list()
    {
        $messages = ChMessage::all();

        return view('backend.layouts.message_list', compact('messages', 'users'));
    }

    public function get_user($id)
    {
        $users = User::all();

        // $megs = ChMessage::where('from_id',$id)->get();
        // dd($megs);

        // $msgs = ChMessage::join('users','users.id','=','ch_messages.to_id')->get(['users.*','ch_messages.*'])-> where('from_id',$id)->last();

        $megs = [];
        foreach ($users as $user) {

            $m = ChMessage::where('from_id', $id)->where('to_id', $user->id)->join('users', 'users.id', '=', 'ch_messages.to_id')->get(['ch_messages.*','users.id','users.name','users.image'])->last();
            // $m = ChMessage::where('from_id',$id)->where('to_id',$user->id)->get()->last();
            array_push($megs, $m);
        }
        // dd($megs);

        // dd($msgs);        

        return response()->json([
            'status' => 200,
            'megs' => $megs
        ]);
    }

    public function get_convo($from_id, $to_id)
    {

        $convos = ChMessage::join('users', 'users.id', '=', 'ch_messages.from_id')
            ->select('ch_messages.*', 'users.id','users.name','users.image')
            ->where(function ($query) use ($from_id, $to_id) {
                $query->where('ch_messages.from_id', $from_id)
                    ->where('ch_messages.to_id', $to_id);
            })
            ->orWhere(function ($query) use ($from_id, $to_id) {
                $query->where('ch_messages.from_id', $to_id)
                    ->where('ch_messages.to_id', $from_id);
            })
            ->orderBy('ch_messages.created_at', 'asc')
            ->get();

        // dd($convos);
        return response()->json([
            'status' => 200,
            'convos' => $convos
        ]);
    }


    // public function runPythonFunction()
    // {
    //     $command = 'python D:/Projects/Sentiment Analysis/message_review.py sentiment_analysis';
    //     exec($command);
    // }

    public function search($id, $value)
    {
        $users = User::where('name', 'like', '%'.$value.'%')->where('id','<>',$id)->get();
        // $results = ChMessage::join('users', 'users.id', '=', 'ch_messages.to_id')->where('name', 'like', '%'.$value.'%')->get(['users.*', 'ch_messages.*']);

        $names = [];
        foreach ($users as $u) {
            // $m = ChMessage::where('from_id',$id)->where('to_id',$user->id)->get()->last();
            array_push($names, $u->name);
        }

        // dd($usernames);

        return response()->json([
            'status' => 200,
            'names' => $names
        ]);
    }

    public function search_user($from_id, $value)
    {
        $user = User::where('name', '=', $value)->first();
        // $results = ChMessage::join('users', 'users.id', '=', 'ch_messages.to_id')->where('name', '=', $value)->get(['users.*', 'ch_messages.*']);
        
        // dd($results);

        $users = User::all();

        // $megs = ChMessage::where('from_id',$id)->get();
        // dd($megs);

        // $msgs = ChMessage::join('users','users.id','=','ch_messages.to_id')->get(['users.*','ch_messages.*'])-> where('from_id',$id)->last();
        $m = ChMessage::where('from_id', $from_id)->where('to_id', $user->id)->join('users', 'users.id', '=', 'ch_messages.to_id')->get(['ch_messages.*','users.id','users.name','users.image'])->last();
        // $m = ChMessage::where('from_id',$id)->where('to_id',$user->id)->get()->last();
        // array_push($megs, $m);

        // dd($m);


        return response()->json([
            'status' => 200,
            'm' => $m
        ]);
    }
}
