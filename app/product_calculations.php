<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product_calculations extends Model
{
    use SoftDeletes;

    
    protected $table = 'tbl_product_calculations';
    public function products()
    {
        return $this->belongsTo('App\products', 'product_id');
        
    }
    public function User()
    {
        return $this->belongsTo('App\User', 'responsible');
        
    }

}
