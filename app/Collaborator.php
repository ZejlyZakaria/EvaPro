<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    public $table = 'collaborators';

    public function projects()
    {
        return $this->hasMany('App\Project');
    }

    public function payment()
    {
        return $this->hasOne('App\Payment');
    }
}
