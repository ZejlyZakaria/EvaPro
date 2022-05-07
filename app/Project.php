<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $table = 'projects';

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function commission(){
        return $this->hasOne('App\Commission');
    }

    public function billing(){
        return $this->hasOne('App\Billing');
    }

    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }

    public function calendars()
    {
        return $this->hasMany('App\Calendar');
    }

}
