<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends User
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'users';

//    public function country()
//    {
//        return $this->belongsToMany(Country::class); // TODO: Change the autogenerated stub
//    }


}