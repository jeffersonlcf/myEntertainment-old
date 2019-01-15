<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntertainmentType extends Model
{
    public function entertainments()
    {
        return $this->hasMany('App\Models\Entertainment');
    }
}
