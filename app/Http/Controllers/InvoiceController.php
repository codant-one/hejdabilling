<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Company;
use App\Models\Client;
use App\Models\Currency;
use App\Models\Invoice;
use App\Models\Item;
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
        $currencies = Currency::all();
        $user = User::where('id',auth()->user()->id)->first(); 
        $cant_invoice = $user->user_client->flatMap(function ($client) {
            return $client->invoice;
        })->count();
        return view("admin.invoice.add", compact('client','company','currencies','cant_invoice'));
    }
    

    public function list_client()
    {
        $user = auth()->user();
        $clients = Client::with(['user'])->where('user_id',$user->id)->get();
        $total_clients = $clients->count();
        return view("admin.invoice.list-clients",compact('clients','total_clients'));
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
        //$pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.invoice.pdf.plantilla')->setOptions(['defaultFont' => 'sans-serif'])->save(storage_path('app/public/pdfs').'/'.'prueba'.'.pdf');
        
        
        $costos = $request->input('cost');
        $items = $request->input('item-details');
        $qtys = $request->input('qty');
        $date_ini = $request->date_hidden;
        $due_date = $request->duedate_hidden;
        $currency = Currency::where('id', $request->typecurrency)->first();

        
        $prices = [];
        
        $user = User::where('id',auth()->user()->id)->first();
        $client = Client::with(['user'])->where('id',$parametro)->first();
        $company = Company::with(['user','payment_method', 'country'])->where('user_id',auth()->user()->id)->first();
        //Limpiando los array del formulario de campos null
        //dd($prices);

        
        $cant_invoice = $user->user_client->flatMap(function ($client) {
            return $client->invoice;
        })->count();

        //dd($cant_invoice);

        $costos = array_filter($costos, function($elemento) {
            return $elemento !== null;
        });
        
        $items = array_filter($items, function($elemento2) {
            return $elemento2 !== null;
        });
        
        $qtys = array_filter($qtys, function($elemento3) {
            return $elemento3 !== null;
        });
        $lenght_array = count($costos);
        $subtotal = 0;
        for ($i=0; $i < $lenght_array ; $i++) { 
            $prices[$i]= $costos[$i]*$qtys[$i];
            $subtotal = $subtotal + $prices[$i];
        }

        //calculamos el número de facturas

        
        

        //Creamos y guardamos los datos de la nueva factura
        $invoice = new Invoice();
        $invoice->client_id = $client->id;
        $invoice->payment_method_id = $company->payment_method[0]->id;
        $invoice->currency_id = $currency->id;
        $invoice->date = $date_ini;
        $invoice->due_date = $due_date;
        $invoice->num_invoice = $cant_invoice;
        $invoice->total = $subtotal;
        $invoice->save();
       

        for ($i=0; $i < $lenght_array ; $i++) { 
            $item = new Item();
            $item->invoice_id = $invoice->id;
            $item->description = $items[$i];
            $item->price = $costos[$i];
            $item->qty = $qtys[$i];
            $item->save();
        }

        $invo_items = Item::where('invoice_id',$invoice->id)->get();
        //dd($items);

        //dd($prices);
        //$pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.invoice.pdf.invoice',compact('costos','items','qtys','prices','user','client','company','date_ini','due_date','subtotal','currency'))->setOptions(['defaultFont' => 'sans-serif'])->save(storage_path('app/public/pdfs').'/'.'prueba'.'.pdf');
        return view('admin.invoice.preview', compact('invoice','invo_items','cant_invoice','client','company','currency','prices'));
        //return $pdf->download('invoice-hejdabilling.pdf');
    }

    public function preview()
    {
        return view('admin.invoice.preview');
    }

    public function edit_client($id)
    {
        $client = Client::find($id);

        return view('admin.invoice.edit_client', compact('client'));

    }

    public function update_client(Request $request, $id)
    {
        $client = Client::find($id);

        if($request->name === null)
        {
            $client->name_company = $request->name_company;
            $client->org_num = $request->org_num;
        }

        else
        {
            $client->name = $request->name;
            $client->lastname = $request->lastname;
        }

        $client->address = $request->address;
        $client->phone = $request->phone;
        $client->save();

        return redirect()->route('invoice.client')->with('jsAlert','Client data updated successfully.');

    }

    public function invoice_client($id)
    {
        $invoices = Invoice::with(['client','item'])->where('client_id',$id)->get();
        $client = Client::find($id);
        $due_total = $invoices->sum('total'); 
        $total_invoices = $invoices->count();
        return view('admin.invoice.invoices-client',compact('invoices', 'client','due_total','total_invoices'));
    }

}
