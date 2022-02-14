<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente', 'cliente_id');
    }

    public function detalleVenta(){
        return $this->hasMany('App\Models\DetalleVenta', 'venta_id');
    }

    public function usuario(){
        return $this->belongsTo('App\Models\User', 'user_registro_id');
    }

    public function usuarioAnula(){
        return $this->belongsTo('App\Models\User', 'user_anula_id');
    }
}
