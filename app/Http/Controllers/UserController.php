<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function index() {
        $users = DB::table('users')->get();
        return view('user.index', ['users' => $users]);
    }

    public function registerUser(Request $req) {
        $validateData = $req->validate([
            'name' => 'required|regex:/^[a-z A-Z]+$/u',
            'email' => 'required|email',
            'password' => 'required|min:6|max:12',
            'confirm_password' => 'required|same:password',
        ]);

        $result = DB::table('users')
        ->where('email', $req->input('email'))
        ->get();

        $res = json_decode($result, true);
        print_r($res);

        if(sizeof($res)==0) {
            $data = $req->input();
            $user = new User;
            $user->name = $data['name'];
            $user->email = $data['email'];
            $encrypted_password = Hash::make($data['password']);
            $user->password = $encrypted_password;
            $user->save();
            $req->session()->flash('register_status', 'User has been registered successfully! You can now log in.');
            return redirect('/');
            echo(Session::get('register_status'));
        } else {
            $req->session()->flash('register_status', 'This Email already exists.');
            return redirect('/login');
            echo(Session::get('user'));
        }   
    }

    public function loginUser(Request $req) {
        $validateData = $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $result = DB::table('users')
        ->where('email', $req->input('email'))
        ->get();

        $res = json_decode($result, true);
        print_r($res);

        if (sizeof($res) == 0) {
            $req->session()->flash('error', 'Email Id does not exist. Please register yourself first');
            echo "Email Id Does not Exist.";
            return redirect('/register');
        } else {
            $encrypted_password = $result[0]->password;
            echo "Hello";
            if (Hash::check($req->input('password'), $encrypted_password)) {
                echo "You are logged in Successfully";
                $req->session()->put('user', $result[0]->name);
                $req->session()->put('userid', $result[0]->email);
                return redirect('/');
            } else {
                $req->session()->flash('error', 'Password Incorrect!');
                echo "Email Id Does not Exist.";
                return redirect('/login');
            }
        }
    }

}
