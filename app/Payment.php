<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $table = 'payments';

    public function balance()
    {
        return $this->hasOne('App\Balance');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function billing()
    {
        return $this->belongsTo('App\Billing');
    }
}
