<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    public $table = 'transfers';

    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }

    public function transfers()
    {
        return $this->hasMany('App\Transfer');
    }
}
