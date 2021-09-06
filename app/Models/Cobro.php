<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cobro extends Model
{
    use HasFactory;

    protected $table = 'cobros';

    public function cliente(){
        return $this->hasOne('App\Models\Cliente','id', 'cliente_id');
    }
}
