<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class products extends Model
{
    use SoftDeletes;

    
    protected static function boot() 
    {
      parent::boot();


      static::deleting(function($products) {
        foreach ($products->product_calculations()->get() as $cal) {
           $cal->delete();
        }
     });
    }

    protected $table = 'tbl_products';
    public function categories()
    {
        return $this->belongsTo('App\categories', 'category_id');
        
    }
    public function product_calculations()
    {
        return $this->hasMany('App\product_calculations', 'product_id');
        
    }
}
