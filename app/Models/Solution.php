<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{

    protected $guarded = [];

    public function sub_category()
    {
        return $this->belongsTo(SSubCategory::class, 's_sub_category_id');
    }

}