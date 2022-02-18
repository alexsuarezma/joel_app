<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\SectorLote;

class SectorLoteController extends Controller
{
    public function create(Request $request){

        $validatedData = $request->validate([
            'descripcion' => 'required|string|max:100',
            'data' => 'required|string|max:2',
            // 'codigo_padre' => ['exclude_if:other_site,"true"','required', 'string', 'max:200'],
            // 'codigo_padre' => 'numeric',
            'hectareas_area' => 'required|numeric',
            'vigencia'  => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            $sector_lote = new SectorLote();

            $sector_lote->descripcion = $request->input('descripcion');
            $sector_lote->data = $request->input('data');
            $sector_lote->codigo_padre = !empty($request->input('codigo_padre')) ? $request->input('codigo_padre') : null;
            $sector_lote->hectareas_area = $request->input('hectareas_area');
            $sector_lote->dualidad_mes = !empty($request->input('dualidad_mes')) ? $request->input('dualidad_mes') : null;
            $sector_lote->vigencia = $request->input('vigencia');

            $sector_lote->save();

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

    public function update(Request $request){
        $validatedData = $request->validate([
            'id' => 'required|numeric',
            'descripcion' => 'required|string|max:100',
            'data' => 'required|string|max:2',
            'codigo_padre' => 'numeric',
            'hectareas_area' => 'required|numeric',
            'vigencia'  => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            $sector_lote = SectorLote::where('id', $request->input('id'))->first();

            if(!$sector_lote){
                throw new \Exception("El Sector/Hectarea al que intenta acceder no se encuentra", 1);
            }

            $sector_lote->descripcion = $request->input('descripcion');
            $sector_lote->data = $request->input('data');
            $sector_lote->codigo_padre = !empty($request->input('codigo_padre')) ? $request->input('codigo_padre') : null;
            $sector_lote->hectareas_area = $request->input('hectareas_area');
            $sector_lote->dualidad_mes = !empty($request->input('dualidad_mes')) ? $request->input('dualidad_mes') : null;
            $sector_lote->vigencia = $request->input('vigencia');


            $sector_lote->update();

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

    public function updateVigencia(Request $request){
        $validatedData = $request->validate([
            'id' => 'required|numeric',
            'vigencia'  => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            $sector_lote = SectorLote::where('id', $request->input('id'))->first();

            if(!$sector_lote){
                throw new \Exception("El Sector/Hectarea al que intenta acceder no se encuentra", 1);
            }

            $sector_lote->vigencia = $request->input('vigencia');
            $sector_lote->update();

            DB::commit();
        } catch(Illuminate\Database\QueryException $error){
            DB::rollback();
            return redirect()->back()->withInput()->with('error', "Hubo un error: {$error->getMessage()}");
        }
        catch(\Exception $error){
            DB::rollback();
            return redirect()->back()->withInput()->with('error', "Hubo un error: {$error->getMessage()}");
        }

        return redirect()->back()->with('success', "Información eliminada satisfactoriamente"); 
    }

    public function index(){
        return view('admin.sector_lote.index');
    }

    public function updateView($id){
        $sector_lote = SectorLote::find($id);
        return view('admin.sector_lote.actualizar', [
            'sector_lote' => $sector_lote,
            'sectores' => SectorLote::where('data', 'SC')->where('vigencia',1)->get(),
        ]);
    }

    public function register(){
        return view('admin.sector_lote.create', [
            'sectores' => SectorLote::where('data', 'SC')->where('vigencia',1)->get(),
        ]);
    }
}
