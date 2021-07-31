<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    public $table = 'billings';

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function balance()
    {
        return $this->hasOne('App\Balance');
    }
}
