<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectorLote extends Model
{
    use HasFactory;

    protected $table = 'sector_lotes';

    public function sector()
    {
        return $this->hasOne('App\Models\SectorLote', 'codigo_padre');
    }
}
