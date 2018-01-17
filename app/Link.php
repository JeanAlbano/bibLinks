<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
	protected $fillable = [
        'descricao', 'url', 'categoria_id'
    ];
    
    public function categoria()
    {
    	return $this->belongsTo(Categoria::class);
    	// relacionamente entre a categoria
    }
}
