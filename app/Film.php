<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = ['imdb_id', 'title', 'year', 'type'];
}
