<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;
    protected  $table = 'products';
    protected $dates = ['deleted_at'];

    public function attributes()
    {
        return $this->hasMany('App\ProductAttribute','product_id');
    }
}
