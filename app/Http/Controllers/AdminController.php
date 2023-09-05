<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Carbon\Carbon;
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

    public function profile()
    {
        return view("admin.dashboard.profile.index");
    }

    public function profile_edit()
    {
       return view("admin.dashboard.profile.edit");   
    }

    public function profile_update(Request $request)
    {

        $users = User::find(auth()->user()->id);
        $request->validate([
            'logo_company' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($request->hasFile('avatar'))
        {

            $file_avatar = $request->file('avatar');
            $file_nameavatar = "a-".$users->name.Carbon::now()->format('Y-m-d').".".$file_avatar->extension();
            $file_avatar->storeAs('avatars', $file_nameavatar,'public');
            $users->avatar = env('APP_URL').'/storage/avatars'.'/'.$file_nameavatar;

        }

        if ($request->hasFile('logo_company')) 
        { 
            $file = $request->file('logo_company');
            $file_name = $users->name.Carbon::now()->format('Y-m-d').".".$file->extension();
            $file->storeAs('logos', $file_name,'public');
            $users->logo_company = env('APP_URL').'/storage/logos'.'/'.$file_name;
             
        }

        $users->save();
        return view("admin.dashboard.profile.edit"); 
       
        

    }
}
