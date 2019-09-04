<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    //
    protected $table = "children";
    
    public function account(){
        return $this->hasBelongsTo('App\Account');
    }
}
