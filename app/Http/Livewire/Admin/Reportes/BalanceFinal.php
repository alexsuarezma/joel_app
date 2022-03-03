<?php

namespace App\Http\Livewire\Admin\Reportes;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

use App\Models\Gasto;
use App\Models\Produccion;
use App\Models\Venta;

use Carbon\Carbon;

class BalanceFinal extends Component
{
    public $anio;

    public function mount(){
        $this->anio = date('Y',strtotime(\Carbon\Carbon::now()));
    }

    public function render()
    {
        
        return view('livewire.admin.reportes.balance-final',[
            'produccion_total' => Produccion::select(DB::raw("ifnull(sum(produccion.total_produccion),0) as produccion"))
                    ->where('anulado', 0)
                    ->whereYear('fecha_documento', $this->anio)
                    ->first(),
            'venta_total' => Venta::select(DB::raw("ifnull(sum(ventas.total_venta),0) as venta"))
                    ->where('anulado', 0)
                    ->whereYear('fecha_documento', $this->anio)
                    ->first(),
            'gastos_total' => Gasto::select(DB::raw("ifnull(sum(gastos.total_gasto),0) as gastos"))
                    ->where('anulado', 0)
                    ->whereYear('fecha_documento', $this->anio)
                    ->first(),
            'gastos_ventas_produccion' => DB::table('vw_balance_final')->where('anio', $this->anio)->get(),
            'ventas_promedio' => Venta::select(DB::raw("ifnull(sum(ventas.total_venta),0) as ventas, avg(detalle_ventas.precio_unitario) precio_promedio, ventas.tipo_venta"))
                                    ->join("detalle_ventas", "ventas.id", '=', 'detalle_ventas.venta_id', 'left outer')
                                    ->where('ventas.anulado', 0)
                                    ->whereYear('ventas.fecha_documento', $this->anio)
                                    ->groupBy('ventas.tipo_venta')
                                    ->get()
        ]);
    }

    public function sumLessYear($action){
        
        if($action == 'sum'){
            $this->anio++;
        }else{
            $this->anio--;
        }
    }
}
