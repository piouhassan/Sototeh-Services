<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SCategory extends Model
{
    protected $guarded = [];

    public function sub_categories()
    {
        return $this->hasMany(SSubCategory::class);
    }

    public function solutions()
    {
        return $this->hasManyThrough(Solution::class, SSubCategory::class);
    }

}