<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $guarded= [];
    // public function service(){
    //     return $this->belongsToMany(service::class,'service_products','serviceId','productId');
    // }
}
