<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    public $table = 'balances';

    public function billing()
    {
        return $this->belongsTo('App\Billing');
    }

    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }

}
