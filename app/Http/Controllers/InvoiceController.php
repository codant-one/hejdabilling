<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Company;
use App\Models\Client;
use Carbon\Carbon;
use Validator;
use Illuminate\Validation\Rule;
use PDF;

class InvoiceController extends Controller
{
    
    public function create_invoice($id)
    {
        $client = Client::with(['user'])->where('id',$id)->first();
        $company = Company::with(['user','payment_method', 'country'])->where('user_id',auth()->user()->id)->first();
        return view("admin.invoice.add", compact('client','company'));
    }
    

    public function list_client()
    {
        $user = auth()->user();
        $clients = Client::with(['user'])->where('user_id',$user->id)->get();
        return view("admin.invoice.list-clients",compact('clients'));
    }

    public function add_client(Request $request)
    {
        $user = User::with(['user_client'])->find(auth()->user()->id);
        
        if(isset($user->user_client))

        {   
            //dd($user->user_client);
            foreach ($user->user_client as $client) 
            {
                if($client->email === $request->email)
                {
                    
                    return redirect()->route('invoice.client')->with('jsAlerterror','A customer with the email or Org Number has already been added previously.');
                }

                elseif($request->org_num!==null && $client->org_num === $request->org_num)
                {
                    return redirect()->route('invoice.client')->with('jsAlerterror','A customer with the email or Org Number has already been added previously.'); 
                }

                
                
            }
        }
                    $clients = new Client();
                    $clients->user_id = $user->id;
                    $clients->type_client_id = $request->customRadioTemp;
                    $clients->name = $request->name;
                    $clients->lastname = $request->lastname;
                    $clients->email = $request->email;
                    $clients->name_company = $request->name_company;
                    $clients->org_num = $request->org_num;
                    $clients->address = $request->address;
                    $clients->phone = $request->phone;
                    $clients->save();
                    
                    return redirect()->route('invoice.client')->with('jsAlert', "Customer successfully registered.");

        


        
        
   

    }

    public function generate_invoice(Request $request, $parametro)

    {
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.invoice.pdf.plantilla')->setOptions(['defaultFont' => 'sans-serif'])->save(storage_path('app/public/pdfs').'/'.'prueba'.'.pdf');
        

        return $pdf->download('invoice-hejdabilling.pdf');
    }

    public function preview()
    {
        return view('admin.invoice.pdf.invoice');
    }

}
