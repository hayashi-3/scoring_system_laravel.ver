<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $fillable = [
        'question',
    ];

    public function correctAnswers()
    {
        return $this->hasMany('App\CorrectAnswers');
    }
}
