<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntertainmentType extends Model
{
    protected $keyType = 'string';
    protected $primaryKey = 'type';

    public function entertainments()
    {
        return $this->hasMany('App\Models\Entertainment');
    }
}
