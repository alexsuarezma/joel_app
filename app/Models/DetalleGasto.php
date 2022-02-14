<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleGasto extends Model
{
    use HasFactory;
    
    protected $table = 'detalles_gastos';

    public function sectorLote()
    {
        return $this->belongsTo('App\Models\SectorLote', 'sector_lote_id');
    }

    public function gasto()
    {
        return $this->belongsTo('App\Models\Gasto', 'gasto_id');
    }

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto', 'producto_id');
    }

}
