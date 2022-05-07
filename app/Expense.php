<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public $table = 'expenses';

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function projects()
    {
        return $this->belongsTo('App\Project');
    }

}
