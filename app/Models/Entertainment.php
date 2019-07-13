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
        return $this->hasOne('App\Models\EntertainmentDetail');
    }

    public function urls()
    {
        return $this->hasMany('App\Models\URL');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User','entertainment_user')
        ->withPivot('rating', 'favourite', 'seen', 'tbseen', 'ntbseen')
        ->withTimestamps();
    }

    public function poster()
    {
        return $this->hasOne('App\Models\Poster');
    }
}
