<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;

class AdminController extends Controller
{
    public function index()
    {
        return view("admin.login.index");
    }

    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        
        if(Auth::attempt($credentials)){
            return redirect()->route('admin.dashboard');
        } else {
            //return back()->withInput();
            return redirect()->route('admin.index')->with('jsAlerterror', "Correo o contraseña equivocada");
            
        }

        
    }


    public function dashboard()
    {
        return view("admin.dashboard.index");
    }
}
