<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Calendar extends Model
{
    public $table = 'calendars';

    public function projects()
    {
        return $this->belongsTo('App\Projet');
    }

    
}
