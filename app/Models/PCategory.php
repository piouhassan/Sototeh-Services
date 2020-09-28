<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PCategory extends Model
{

    protected $guarded = [];

    public function sub_categories()
    {
        return $this->hasMany(PSubCategory::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, PSubCategory::class);
    }

}