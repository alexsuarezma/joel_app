<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;


class VentaController extends Controller
{

    public function create(Request $request){

        $validatedData = $request->validate([
            'comentario' => 'string|max:100',
            'fecha_documento' => 'required|date',
            'cliente_id' => 'required|numeric',
            'tipo_venta' => 'required|string|max:100',
            // 'total_venta' => 'required|numeric',
            'producto_id' => 'required|array|min:1',
            'producto_id.*' => 'required|numeric',
            'cantidad' => 'required|array|min:1',
            'cantidad.*' => 'required|numeric',
            'cajas' => 'required|array|min:1',
            'cajas.*' => 'required|numeric',
            'precio_unitario' => 'required|array|min:1',
            'precio_unitario.*' => 'required|numeric',
            'unidad_medida' => 'required|array|min:1',
            'unidad_medida.*' => 'required|string',
            'factor' => 'required|array|min:1',
            'factor.*' => 'required|numeric',
            'total' => 'required|array|min:1',
            'total.*' => 'required|numeric',
        ]);
        
        try {

            DB::beginTransaction();

            $venta = new Venta();
            $totalDocumento = 0;


            $venta->cliente_id = $request->input('cliente_id');
            $venta->tipo_venta = $request->input('tipo_venta');
            $venta->comentario = $request->input('comentario');
            $venta->fecha_documento = date("Y/m/d", strtotime($request->input('fecha_documento')));
            $venta->user_registro_id = \Auth::user()->id;

            $venta->save();

            foreach ($request->input('producto_id') as $index => $product){
                $detalle_venta = new DetalleVenta();

                $producto = Producto::where('id', $request->input('producto_id')[$index])->first();
                
                if(!$producto){
                    throw new \Exception("El Producto al que intenta acceder no se encuentra", 1);
                }
                $producto->stock = $producto->stock - $request->input('cantidad')[$index];
                
                if($producto->stock < 0){
                    throw new \Exception("El producto '{$producto->descripcion}' no tiene stock suficiente.", 1);
                }
                $producto->update();

                
                $detalle_venta->secuencia = $index + 1;
                $detalle_venta->venta_id = $venta->id;
                $detalle_venta->producto_id = $request->input('producto_id')[$index];
                $detalle_venta->cantidad = $request->input('cantidad')[$index];
                $detalle_venta->cajas = $request->input('cajas')[$index];
                $detalle_venta->precio_unitario = $request->input('precio_unitario')[$index];
                $detalle_venta->unidad_medida = $request->input('unidad_medida')[$index];
                $detalle_venta->factor = $request->input('factor')[$index];
                $detalle_venta->total = $request->input('total')[$index];
                $totalDocumento += $request->input('total')[$index];

                $detalle_venta->save();
            }

            $venta->total_venta = $totalDocumento;
            $venta->update();

            DB::commit();
        } catch(Illuminate\Database\QueryException $error){
            DB::rollback();
            return redirect()->back()->withInput()->with('error', "Hubo un error: {$error->getMessage()}");
        }
        catch(\Exception $error){
            DB::rollback();
            return redirect()->back()->withInput()->with('error', "Hubo un error: {$error->getMessage()}");
        }

        return redirect()->back()->with('success', "Información creada satisfactoriamente"); 
    }

    public function anular(Request $request){
        $validatedData = $request->validate([
            'id' => 'required|numeric',
            'comentario_anulacion' => 'required|string|max:100',
            'password' => 'required|string|password',
        ]);

        try {
            DB::beginTransaction();

            $venta = Venta::where('id', $request->input('id'))->first();

            if(!$venta){
                throw new \Exception("La venta a la que intenta acceder no se encuentra", 1);
            }

            foreach($venta->detalleVenta as $detalle){

                $producto = Producto::where('id', $detalle->producto_id)->first();
                
                if(!$producto){
                    throw new \Exception("El Producto al que intenta acceder no se encuentra", 1);
                }

                $producto->stock = $producto->stock + $detalle->cantidad;

                $producto->update();
            }

            $venta->comentario_anulacion = $request->input('comentario_anulacion');
            $venta->user_anula_id = \Auth::user()->id;
            $venta->anulado = 1;


            $venta->update();

            DB::commit();
        } catch(Illuminate\Database\QueryException $error){
            DB::rollback();
            return redirect()->back()->withInput()->with('error', "Hubo un error: {$error->getMessage()}");
        }
        catch(\Exception $error){
            DB::rollback();
            return redirect()->back()->withInput()->with('error', "Hubo un error: {$error->getMessage()}");
        }

        return redirect()->back()->with('success', "Información actualizada satisfactoriamente"); 
    }


    public function index(){
        return view('venta.index');
    }

    public function updateView($id){
        $venta = Venta::find($id);
        return view('venta.actualizar', [
            'venta' => $venta,
        ]);
    }

    public function register(){
        return view('venta.create');
    }
}
