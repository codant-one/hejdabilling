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

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if (auth()->user()->can('user_ban')) {
                abort(403, 'Ud ha sido baneado, no tienes permiso para esta acción.');
            }

            if (env('APP_DEBUG')) {
                session()->put('2fa', '1');

                return redirect()->route('admin.dashboard');
             }

            if (empty($user->token_2fa)) {
                $google2fa = app('pragmarx.google2fa');
                $token = $google2fa->generateSecretKey();

                $user->token_2fa = $token;
                $user->update();

                $request->session()->flash('user', $user);

                return redirect()->route('auth.2fa.generate');
            } else {
                return redirect(route('auth.2fa'));
            }
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coindicen.',
        ]);
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


    public function validate_double_factor_auth(Request $request)
    {
        $user = auth()->user();
        $google2fa = app('pragmarx.google2fa');
        
        if ($google2fa->verifyKey($user->token_2fa, $request->otp)) {
            session()->put('2fa', '1');
            session()->put('login', 'admin');

            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->withErrors(['error' => 'Código de verificación incorrecto']);
    }

    public function generate_double_factor_auth()
    {
        $google2fa = app('pragmarx.google2fa');

        $user = auth()->user();
        $token = $user->token_2fa;

        $qr = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $token
        );

        return view('admin.login.two-steps', compact('user', 'qr', 'token'));
    }

    public function double_factor_auth()
    {
        $user = auth()->user();
        $token = $user->token_2fa;

        return view('admin.login.2fa', compact('user', 'token'));
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

        $users->name = $request->name;
        $users->lastname = $request->lastname;
        $users->company = $request->company;
        $users->phone_company = $request->phone_company;
        $users->address_company = $request->address_company;

        $users->save();
        return view("admin.dashboard.profile.index"); 
       
        

    }

    public function two_steps()
    {
        return view("admin.login.two-steps");
    } 
}
