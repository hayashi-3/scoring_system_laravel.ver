<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CorrectAnswers extends Model
{
    protected $fillable = [
        'answer',
    ];
    
    public function question()
    {
        return $this->belongsTo('App\Questions');
    }
    
}
