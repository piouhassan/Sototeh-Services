<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(SeCategory::class, 'se_category_id');
    }
}