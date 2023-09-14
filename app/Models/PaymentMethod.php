<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Company;
use App\Models\Invoice;
class PaymentMethod extends Model
{
    use HasFactory;

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function invoice() 
    {
        return $this->hasMany(Invoice::class, 'payment_method_id', 'id');
    }
}
