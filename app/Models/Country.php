<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
class Country extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    /**** Relationship ****/
   


    /**** Public methods ****/
    public static function forDropdown()
    {
        return DB::table('countries as c')
            ->select(['c.id', 'c.name'])
            ->orderBy('name')
            ->get()->pluck('name','id');
        
    }

    public static function phonePrefix()
    {
        return DB::table('countries as c')
            ->select(['c.id', 'c.phonecode'])
            ->orderBy('id')
            ->get()->pluck('phonecode','id');
        
    }

    public function company()
    {
        return $this->hasMany(Company::class, 'country_id', 'id'); 
    }
   
}
