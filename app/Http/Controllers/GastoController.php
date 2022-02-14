<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Gasto;
use App\Models\DetalleGasto;

class GastoController extends Controller
{
    public function create(Request $request){

        $validatedData = $request->validate([
            'comentario' => 'string|max:100',
            'fecha_documento' => 'required|date',
            'sector_lote_id' => 'required|numeric',
            // 'total_gasto' => 'required|numeric',
            // 'sector_lote_id_detalle' => 'required|array|min:1',
            // 'sector_lote_id_detalle.*' => 'required|numeric',
            'producto_id' => 'required|array|min:1',
            'producto_id.*' => 'required|numeric',
            'cantidad' => 'required|array|min:1',
            'cantidad.*' => 'required|numeric',
            'hectareas_aplicado' => 'required|array|min:1',
            'hectareas_aplicado.*' => 'required|numeric',
            'costo' => 'required|array|min:1',
            'costo.*' => 'required|numeric',
            'unidad_medida' => 'required|array|min:1',
            'unidad_medida.*' => 'required|string|max:13',
            'factor' => 'required|array|min:1',
            'factor.*' => 'required|numeric',
            'total' => 'required|array|min:1',
            'total.*' => 'required|numeric',
        ]);
        
        try {

            DB::beginTransaction();

            $gasto = new Gasto();
            $totalDocumento = 0;

            $gasto->comentario = $request->input('comentario');
            $gasto->fecha_documento = date("Y/m/d", strtotime($request->input('fecha_documento')));
            $gasto->sector_lote_id = $request->input('sector_lote_id');
            $gasto->user_registro_id = \Auth::user()->id;

            $gasto->save();

            foreach ($request->input('producto_id') as $index => $product){
                $detalle_gasto = new DetalleGasto();
                
                $detalle_gasto->secuencia = $index + 1;
                $detalle_gasto->gasto_id = $gasto->id;
                $detalle_gasto->sector_lote_id = $gasto->sector_lote_id; //$request->input('sector_lote_id_detalle')[$index];
                $detalle_gasto->producto_id = $request->input('producto_id')[$index];
                $detalle_gasto->cantidad = $request->input('cantidad')[$index];
                $detalle_gasto->hectareas_aplicado = $request->input('hectareas_aplicado')[$index];
                $detalle_gasto->costo = $request->input('costo')[$index];
                $detalle_gasto->unidad_medida = $request->input('unidad_medida')[$index];
                $detalle_gasto->factor = $request->input('factor')[$index];
                $detalle_gasto->total = $request->input('total')[$index];
                $totalDocumento += $request->input('total')[$index];

                $detalle_gasto->save();
            }

            $gasto->total_gasto = $totalDocumento;
            $gasto->update();

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

            $gasto = Gasto::where('id', $request->input('id'))->first();

            if(!$gasto){
                throw new \Exception("El gasto al que intenta acceder no se encuentra", 1);
            }

            $gasto->comentario_anulacion = $request->input('comentario_anulacion');
            $gasto->user_anula_id = \Auth::user()->id;
            $gasto->anulado = 1;


            $gasto->update();

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
        return view('gasto.index');
    }

    public function updateView($id){
        $gasto = gasto::find($id);
        return view('gasto.actualizar', [
            'gasto' => $gasto,
        ]);
    }

    public function register(){
        return view('gasto.create');
    }
}
