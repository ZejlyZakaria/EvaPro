<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    public $table = 'commissions';

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
