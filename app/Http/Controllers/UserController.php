<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function all()
    {
        return view('user.all');
    }

    public function create()
    {
        return view('welcome');
    }
}
