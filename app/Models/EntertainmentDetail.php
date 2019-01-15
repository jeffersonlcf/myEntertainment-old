<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntertainmentDetail extends Model
{
    public function entertainment()
    {
        return $this->belongsTo('App\Models\Entertainment', 'entertainment_id');
    }
}
