<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public function link(){
    	return $this->hasMany(Link::class);
        // "hasOne" porque um link possui apenas uma categoria
    }	
}
