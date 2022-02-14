<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produccion extends Model
{
    use HasFactory;

    protected $table = 'produccion';

    public function sectorLote()
    {
        return $this->belongsTo('App\Models\SectorLote', 'sector_lote_id');
    }

    public function detalleProduccion(){
        return $this->hasMany('App\Models\DetalleProduccion', 'produccion_id');
    }

    public function usuario(){
        return $this->belongsTo('App\Models\User', 'user_registro_id');
    }

    public function usuarioAnula(){
        return $this->belongsTo('App\Models\User', 'user_anula_id');
    }
}
