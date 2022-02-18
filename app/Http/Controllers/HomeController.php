<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Gasto;
use App\Models\Produccion;
use App\Models\Venta;
use App\Models\Empleado;
use App\Models\Producto;

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

        $produccion_total = Produccion::select(DB::raw("ifnull(sum(produccion.total_produccion),0) as produccion"))
                ->where('anulado', 0)
                ->whereYear('fecha_documento', date('Y', strtotime(\Carbon\Carbon::now())))
                ->first();

        $venta_total = Venta::select(DB::raw("ifnull(sum(ventas.total_venta),0) as venta"))
                ->where('anulado', 0)
                ->whereYear('fecha_documento', date('Y', strtotime(\Carbon\Carbon::now())))
                ->first();

        $gastos_total = Gasto::select(DB::raw("ifnull(sum(gastos.total_gasto),0) as gastos"))
                ->where('anulado', 0)
                ->whereYear('fecha_documento', date('Y', strtotime(\Carbon\Carbon::now())))
                ->first();

        $empleados = Empleado::select(DB::raw("ifnull(sum(empleados.id),0) as empleados"))->first();

        $gastos_ventas =  DB::table('vw_gastos_ventas')->where('anio', date('Y',strtotime(\Carbon\Carbon::now())))->get();

        $gastos_produccion =  DB::table('vw_gastos_produccion')->where('anio', date('Y',strtotime(\Carbon\Carbon::now())))->get();

        $productos = Producto::select('id','stock','descripcion','unidad_medida')->where('tipo_producto', '2')->get();

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
            'gastos_total' => $gastos_total,
            'produccion_total' => $produccion_total,
            'venta_total' => $venta_total,
            'empleados' => $empleados,
            'datos_gastos' => $datos_gastos,
            'datos_ventas' => $datos_ventas,
            'gastos_produccion' => $gastos_produccion,
            'productos' => $productos,
            'month' => $month
        ]);
    }
}
