<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entertainment extends Model
{
    public function entertainmentType()
    {
        return $this->belongsTo('App\Models\EntertainmentType', 'type_id');
    }

    public function entertainmentDetails()
    {
        return $this->hasMany('App\Models\EntertainmentDetail');
    }
}
