<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Histories extends Model
{
    protected $fillable = [
        'user_id',
        'point',
    ];

    // Eloquentで勝手にupdate_atとcreated_atを更新してくれるが、Historiesのテーブルにはupdated_atしかないのでfalseにする(saveメソッドを使うため)
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
