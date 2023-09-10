<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    
    public function create_invoice()
    {
        return view("admin.invoice.add");
    }

}
