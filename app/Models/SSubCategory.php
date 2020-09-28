<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SSubCategory extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(SCategory::class, 's_category_id');
    }

    public function solutions()
    {
        return $this->hasMany(Solution::class);
    }

    public function timeline()
    {
        return $this->hasMany(STimeline::class);
    }

}