<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class categories extends Model
{
    use SoftDeletes;
    
    protected $table = 'tbl_categories';
    public function products()
    {
        return $this->hasMany('App\products', 'category_id');
        
    }

}
