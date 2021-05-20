<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Histories extends Model
{
    protected $fillable = [
        'point',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
