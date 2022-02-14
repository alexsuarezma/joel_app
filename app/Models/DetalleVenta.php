<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalle_ventas';

    public function venta()
    {
        return $this->belongsTo('App\Models\Venta', 'venta_id');
    }

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto', 'producto_id');
    }
}
