<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Gasto;
use App\Models\Produccion;
use App\Models\Venta;
use App\Models\Empleado;

use Carbon\Carbon;

class HomeController extends Controller
{
    public function dashboard() {
        Carbon::setLocale('es');
        $month = date('M', strtotime(\Carbon\Carbon::now()));

        $gastos = Gasto::select(DB::raw("ifnull(sum(gastos.total_gasto),0) as gastos"))
                ->where('anulado', 0)
                ->whereMonth('fecha_documento', '=', date('m', strtotime(\Carbon\Carbon::now())))
                ->first();

        $produccion = Produccion::select(DB::raw("ifnull(sum(produccion.total_produccion),0) as produccion"))
                ->where('anulado', 0)
                ->whereMonth('fecha_documento', '=', date('m', strtotime(\Carbon\Carbon::now())))
                ->first();

        $venta = Venta::select(DB::raw("ifnull(sum(ventas.total_venta),0) as venta"))
                ->where('anulado', 0)
                ->whereMonth('fecha_documento', '=', date('m', strtotime(\Carbon\Carbon::now())))
                ->first();

        $empleados = Empleado::select(DB::raw("ifnull(sum(empleados.id),0) as empleados"))->first();

        $gastos_ventas =  DB::table('vw_gastos_ventas')->where('anio', date('Y',strtotime(\Carbon\Carbon::now())))->get();
        $datos_gastos = array();
        $datos_ventas = array();
        
        foreach($gastos_ventas as $ga){
            array_push($datos_gastos, $ga->gastos);
            array_push($datos_ventas, $ga->ventas);
        }

        return view('dashboard',[
            'gastos' => $gastos,
            'produccion' => $produccion,
            'venta' => $venta,
            'empleados' => $empleados,
            'datos_gastos' => $datos_gastos,
            'datos_ventas' => $datos_ventas,
            'month' => $month
        ]);
    }
}
