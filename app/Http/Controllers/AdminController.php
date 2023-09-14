<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Client;
use App\Models\Country;
use App\Models\Company;
use App\Models\PaymentMethod;
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
        $companies = Company::with(['user','payment_method', 'country'])->where('user_id',auth()->user()->id)->first();
        $cant_customer = Client::where('user_id', auth()->user()->id)->count();
        //dd($companies);
        return view("admin.dashboard.profile.index", compact('companies','cant_customer'));
    }

    public function profile_edit()
    {
       $countries = Country::forDropdown(); 
       $user = User::with(['company.payment_method'])->find(auth()->user()->id);
       return view("admin.dashboard.profile.edit", compact('countries','user'));   
    }

    public function profile_update(Request $request)
    {

        $users = User::find(auth()->user()->id);
        $companies = Company::with(['user'])->where('user_id',$users->id)->first();

        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if($companies)
        {
           $companies->country_id = $request->country_id;
           $companies->name = $request->company;
           $companies->org_number = $request->org_number;
           $companies->email = $request->email_company;
           $companies->address = $request->address;   
           $companies->phone = $request->phone;    
            if ($request->hasFile('logo')) 
            { 
                $file = $request->file('logo');
                $file_name = $users->name.Carbon::now()->format('Y-m-d').".".$file->extension();
                $file->storeAs('logos', $file_name,'public');
                $companies->logo = env('APP_URL').'/storage/logos'.'/'.$file_name;
                
            }

            $companies->save();

        }
        
        else 
        {
           $company= new Company();
           $company->user_id = $users->id; 
           $company->country_id = $request->country_id;
           $company->name = $request->company;
           $company->org_number = $request->org_number;
           $company->email = $request->email_company;
           $company->address = $request->address;   
           $company->phone = $request->phone;   

           if ($request->hasFile('logo')) 
            { 
                $file = $request->file('logo');
                $file_name = $users->name.Carbon::now()->format('Y-m-d').".".$file->extension();
                $file->storeAs('logos', $file_name,'public');
                $company->logo = env('APP_URL').'/storage/logos'.'/'.$file_name;
                
            }

            $company->save();

            $payment = new PaymentMethod();

            $payment->company_id = $company->id;
            $payment->name_bank = $request->name_bank;
            $payment->account_number = $request->account_number;
            $payment->iban = $request->iban;
            $payment->swish = $request->swish;

            $payment->save();

        }

        if($request->hasFile('avatar'))
        {

            $file_avatar = $request->file('avatar');
            $file_nameavatar = "a-".$users->name.Carbon::now()->format('Y-m-d').".".$file_avatar->extension();
            $file_avatar->storeAs('avatars', $file_nameavatar,'public');
            $users->avatar = env('APP_URL').'/storage/avatars'.'/'.$file_nameavatar;

        }

        

        $users->name = $request->name;
        $users->lastname = $request->lastname;
        //$users->company = $request->company;
        //$users->phone_company = $request->phone_company;
        //$users->address_company = $request->address_company;

        $users->save();

        return redirect()->route('admin.profile')->with('jsAlert', "Data successfully updated");
       
        

    }

    public function two_steps()
    {
        return view("admin.login.two-steps");
    } 
}
