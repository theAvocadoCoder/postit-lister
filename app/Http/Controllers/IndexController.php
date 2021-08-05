<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index() {
        if (session()->get('user')) {
            return view('index');
        } else {
            session()->put('user', null);
            return view('index');
        }
    }

    public function register() {
        return view('registration');
    }

    public function login() {
        return view('login');
    }

    public function logout() {
        session()->put('user', null);
        return redirect('/');
    }
}
