<?php
namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Models\PasswordReset;

class PasswordController extends Controller
{
    
    public function forgot_adminpassword()
    {
            return view("admin.login.forgot-password");

    }

    public function email_adminconfirmation(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        //Si no existe el email.
        if (!$user)
            return redirect()->route('admin.index')->with('jsAlerterror', "Correo no registrado");
        //Crear o Actualizar token.
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $request->email],
            ['token' => Str::random(60)]
        );

        // $passwordReset->save();
        // dd($passwordReset);

        
        $url = env('APP_URL').'/admin/reset-password?token='.$passwordReset['token'];
        

        $data = [
            'title' => 'Password change request',
            'user' => $user->name,
            'text' => 'A password change has been requested, please follow the steps described below ',
            'buttonLink' =>  $url ?? null,
            'buttonText' => 'submit'
        ];

        $adminemail = 'dbolivarv90@gmail.com';
        

        $subject = 'Password change request';
        
        try {
            \Mail::send(
                'emails.auth.forgot_pass_confirmation'
                , $data
                , function ($message) use ($adminemail, $subject) {
                    $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    $message->to($adminemail)->subject($subject);
            });

            $responseMail = "An email was sent with instructions for resetting your password, please check your inbox.";
        } catch (\Exception $e){
            $responseMail =$e->getMessage();
        }        

        return redirect()->route("admin.index")->with('jsAlert', $responseMail);
    }


    public function reset_adminpassword(Request $request)
    {
        $token = $request->token;

        return view('admin.login.reset-password', compact('token') );
        
    }

    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)
            ->first();
        if (!$passwordReset)
            return response()->json([
                "ERROR" => true,'ERROR_MENSAGGE' => "Invalid Token","CODE" =>404], 404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                "ERROR" => true,'ERROR_MENSAGGE' => "Token no found","CODE" =>404], 404);
        }
        $response["message_return"] = array("ERROR" => false,"ERROR_MENSAGGE" => "Success","CODE" =>200);
        $response["result"] = $passwordReset;
        return response()->json($response,200);
    }

    public function admin_change(Request $request)
    {
        //Si Token invalido.
        if ( $this->find($request->token)->status() != 200)
            return redirect()->back()->withErrors('El token es invalido!');

        $tokenValidated = json_decode($this->find($request->token)->content());
        $email = $tokenValidated->result->email;

        $user = User::where('email', $email)->first();

        //Si no existe el email.
        if (!$user)
            return redirect()->back()->withErrors( 'Correo electronico no registrado' );

        $user->password = Hash::make($request->password);
        //$user->token_2fa = null;
        $user->update();

        $response = 'La Contraseña ha sido actualizada';
        return redirect()->route("admin.index")->with( ["register_success"=>$response] );

    }

}
