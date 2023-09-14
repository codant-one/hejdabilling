<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class TypeClient extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->hasMany(Client::class, 'type_client_id', 'id');
    }

}
