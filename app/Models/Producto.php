<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    public function tipoGasto()
    {
        return $this->belongsTo('App\Models\TipoGasto', 'tipo_gasto_id');
    }
}
