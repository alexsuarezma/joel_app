<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    // public function horario(){
    //     return $this->hasManyThrough(
    //         'App\Models\HorarioHasEmpleado',
    //         'App\Models\Horario',
    //         'id',
    //         'empleado_id',
    //         'horario_id',
    //         'id'
    //     );
    // }
    // public function horario(){
    //     return $this->belongsTo('App\Models\Horario','horario_id');
    // }
}
