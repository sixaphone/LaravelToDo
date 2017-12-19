<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * vice cersa one post belongs to a certain user
     */
    public function user(){
        return $this->belongsTo('App\User');    }
}
