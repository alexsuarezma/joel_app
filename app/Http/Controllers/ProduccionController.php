<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Produccion;
use App\Models\DetalleProduccion;
use App\Models\Producto;

class ProduccionController extends Controller
{

    public function create(Request $request){

        $validatedData = $request->validate([
            'comentario' => 'string|max:100',
            'fecha_documento' => 'required|date',
            'sector_lote_id' => 'required|numeric',
            // 'total_produccion' => 'required|numeric',
            'producto_id' => 'required|array|min:1',
            'producto_id.*' => 'required|numeric',
            'cantidad' => 'required|array|min:1',
            'cantidad.*' => 'required|numeric',
            'unidad_medida' => 'required|array|min:1',
            'unidad_medida.*' => 'required|string',
            'factor' => 'required|array|min:1',
            'factor.*' => 'required|numeric',
            'cajas' => 'required|array|min:1',
            'cajas.*' => 'required|numeric',
            'total' => 'required|array|min:1',
            'total.*' => 'required|numeric',
        ]);
        
        try {

            DB::beginTransaction();

            $produccion = new Produccion();
            $totalDocumento = 0;

            $produccion->comentario = $request->input('comentario');
            $produccion->fecha_documento = date("Y/m/d", strtotime($request->input('fecha_documento')));
            $produccion->sector_lote_id = $request->input('sector_lote_id');
            $produccion->user_registro_id = \Auth::user()->id;

            $produccion->save();

            foreach ($request->input('producto_id') as $index => $product){
                $detalle_produccion = new DetalleProduccion();
                $producto = Producto::where('id', $request->input('producto_id')[$index])->first();
                
                if(!$producto){
                    throw new \Exception("El Producto al que intenta acceder no se encuentra", 1);
                }
                $producto->stock = $producto->stock + $request->input('cantidad')[$index];
                $producto->update();

                $detalle_produccion->secuencia = $index + 1;
                $detalle_produccion->produccion_id = $produccion->id;
                $detalle_produccion->producto_id = $request->input('producto_id')[$index];
                $detalle_produccion->cantidad = $request->input('cantidad')[$index];
                $detalle_produccion->cajas = $request->input('cajas')[$index];
                $detalle_produccion->factor = $request->input('factor')[$index];
                $detalle_produccion->unidad_medida = $request->input('unidad_medida')[$index];
                $detalle_produccion->total = $request->input('total')[$index];
                $totalDocumento += $request->input('total')[$index];

                $detalle_produccion->save();
            }

            $produccion->total_produccion = $totalDocumento;
            $produccion->update();

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

            $produccion = Produccion::where('id', $request->input('id'))->first();

            if(!$produccion){
                throw new \Exception("La produccion a la que intenta acceder no se encuentra", 1);
            }

            foreach($produccion->detalleProduccion as $detalle){

                $producto = Producto::where('id', $detalle->producto_id)->first();
                
                if(!$producto){
                    throw new \Exception("El Producto al que intenta acceder no se encuentra", 1);
                }

                $producto->stock = $producto->stock - $detalle->cantidad;
                
                if($producto->stock < 0){
                    throw new \Exception("El producto '{$detalle->producto->descripcion}' no tiene stock suficiente para revertirse.", 1);
                }

                $producto->update();
            }

            $produccion->comentario_anulacion = $request->input('comentario_anulacion');
            $produccion->user_anula_id = \Auth::user()->id;
            $produccion->anulado = 1;


            $produccion->update();

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
        return view('produccion.index');
    }

    public function updateView($id){
        $produccion = Produccion::find($id);
        return view('produccion.actualizar', [
            'produccion' => $produccion,
        ]);
    }

    public function register(){
        return view('produccion.create');
    }

}
