<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';
    protected $dates = ['deleted_at'];

    public function categories()
    {
     return $this->hasmany('App\Category','parent_id');
    }
}


