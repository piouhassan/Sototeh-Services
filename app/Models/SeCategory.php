<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SeCategory extends Model
{
    protected $guarded = [];

    public function solutions()
    {
        return $this->hasMany(Solution::class);
    }

}