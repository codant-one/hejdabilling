<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;

class Item extends Model
{
    use HasFactory;

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'inovice_id', 'id');
    }
}
