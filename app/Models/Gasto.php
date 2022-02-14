<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory;
    
    protected $table = 'gastos';

    public function sectorLote()
    {
        return $this->belongsTo('App\Models\SectorLote', 'sector_lote_id');
    }

    public function detalleGasto(){
        return $this->hasMany('App\Models\DetalleGasto', 'gasto_id');
    }

    public function usuario(){
        return $this->belongsTo('App\Models\User', 'user_registro_id');
    }

    public function usuarioAnula(){
        return $this->belongsTo('App\Models\User', 'user_anula_id');
    }
}

