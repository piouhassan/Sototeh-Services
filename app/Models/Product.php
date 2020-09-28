<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $guarded  = [];

    public function sub_category()
    {
        return $this->belongsTo(PSubCategory::class, 'p_sub_category_id');
    }
}