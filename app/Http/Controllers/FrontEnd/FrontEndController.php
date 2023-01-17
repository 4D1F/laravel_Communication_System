<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function user($id)
    {
        return $id;
    }
}
