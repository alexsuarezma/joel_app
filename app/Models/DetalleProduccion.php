<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleProduccion extends Model
{
    use HasFactory;

    protected $table = 'detalle_produccion';

    public function produccion()
    {
        return $this->belongsTo('App\Models\Produccion', 'produccion_id');
    }

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto', 'producto_id');
    }
}
