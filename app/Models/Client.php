<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;
use App\Models\TypeClient;
use App\Models\Invoice;
class Client extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function type_client()
    {
        return $this->belongsTo(TypeClient::class, 'type_client_id', 'id');
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class, 'client_id', 'id'); 
    }
}
