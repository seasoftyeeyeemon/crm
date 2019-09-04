<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kinder extends Model
{
    public function kids(){
        return $this->hasMany('App\Kid');
    }
}
