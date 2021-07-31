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

    public function collaborator()
    {
        return $this->belongsTo('App\Collaborator');
    }
}
