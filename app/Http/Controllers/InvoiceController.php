<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Client;
use Carbon\Carbon;
use Validator;

class InvoiceController extends Controller
{
    
    public function create_invoice($id)
    {
        $client = Client::with(['user'])->where('id',$id)->first();
        return view("admin.invoice.add", compact('client'));
    }
    

    public function list_client()
    {
        $user = auth()->user();
        $clients = Client::with(['user'])->where('user_id',$user->id)->get();
        return view("admin.invoice.list-clients",compact('clients'));
    }

    public function add_client(Request $request)
    {
        $rules = ['email'   => 'unique:clients'];

        $customErrorMessages = ['email.unique' => 'A customer with this email has already been registered.'];

        $validator = Validator::make($request->all(), $rules, $customErrorMessages);

        $message = ""; 
        if ($validator->fails()) {
            
            $errors = [];

            foreach($validator->errors()->toArray() as $error){
                $message = $error[0];
                return redirect()->route('invoice.client')->with('jsAlerterror', $message);
            }
        }

        $client = new Client();
        $user = auth()->user();
        $client->user_id = $user->id;
        $client->name = $request->name;
        $client->lastname = $request->lastname;
        $client->email = $request->email;
        $client->name_company = $request->name_company;
        $client->address = $request->address;
        $client->phone = $request->phone;
        $client->save();
        
        return redirect()->route('invoice.client')->with('jsAlert', "Customer successfully registered.");
   

    }

}
