<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\TipoGasto;

class TipoGastoController extends Controller
{
    public function create(Request $request){

        $validatedData = $request->validate([
            'descripcion' => 'required|string|max:100',
        ]);

        try {
            DB::beginTransaction();

            $tipo_gasto = new TipoGasto();

            $tipo_gasto->descripcion = $request->input('descripcion');

            $tipo_gasto->save();

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
        ]);

        try {
            DB::beginTransaction();

            $tipo_gasto = TipoGasto::where('id', $request->input('id'))->first();

            if(!$tipo_gasto){
                throw new \Exception("El TipoGasto al que intenta acceder no se encuentra", 1);
            }

            $tipo_gasto->descripcion = $request->input('descripcion');

            $tipo_gasto->update();

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
        $tipos_gasto = TipoGasto::orderBy('created_at','desc')->paginate(10);
        return view('admin.tipo_gasto.index', [
            'tipos_gasto' => $tipos_gasto
        ]);
    }

    public function updateView($id){
        $tipo_gasto = TipoGasto::find($id);
        return view('admin.tipo_gasto.actualizar', [
            'tipo_gasto' => $tipo_gasto,
        ]);
    }

    public function register(){
        return view('admin.tipo_gasto.create');
    }

}
