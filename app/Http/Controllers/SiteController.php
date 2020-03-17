<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function index() {
        if(auth()->guest()) {
            return view('login');
        }else {
            return redirect('/dashboard');
        }
    }

    public function login(Request $request) {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $login = auth()->attempt([
            'username' => $request['username'],
            'password' => $request['password']
        ]);

        if($login) {
            return redirect('/dashboard');
        }else {
            return redirect()->back()->with('Error','Invalid username or password.');
        }
    }

    public function logout() {
        auth()->logout();
        return redirect('/');
    }

    public function dashboard() {
        return view('dashboard');
    }
}
