<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo('App\company');
    }
}
