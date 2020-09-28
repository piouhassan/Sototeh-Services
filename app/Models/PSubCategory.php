<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PSubCategory extends Model
{

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(PCategory::class, 'p_category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}