<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Horario;

class HorarioController extends Controller
{
    public function create(Request $request){

        $validatedData = $request->validate([
            'descripcion' => 'required|string|max:60',
            'hora_inicio' => 'required|regex:/(\d+\:\d+)/',
            'hora_fin' => 'required|regex:/(\d+\:\d+)/|after:hora_inicio',
        ]);

        try {
            DB::beginTransaction();

            $horario = new Horario();

            $horario->descripcion = $request->input('descripcion');
            $horario->hora_inicio = $request->input('hora_inicio'); 
            $horario->hora_fin = $request->input('hora_fin'); 

            $horario->save();

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
            'id' => 'required',
            'descripcion' => 'required|string|max:60',
            'hora_inicio' => 'required|regex:/(\d+\:\d+)/',
            'hora_fin' => 'required|regex:/(\d+\:\d+)/|after:hora_inicio',
        ]);

        try {
            DB::beginTransaction();

            $horario = Horario::where('id', $request->input('id'))->first();

            if(!$horario){
                throw new \Exception("El horario al que intenta acceder no se encuentra", 1);
            }

            $horario->descripcion = $request->input('descripcion');
            $horario->hora_inicio = $request->input('hora_inicio'); 
            $horario->hora_fin = $request->input('hora_fin'); 

            $horario->update();

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


    public function delete(Request $request){
        $validatedData = $request->validate([
            'id' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $horario = Horario::where('id', $request->input('id'))->first();
            
            if(!$horario){
                throw new \Exception("El horario al que intenta acceder no se encuentra", 1);
            }

            $empleados = \App\Models\Empleado::where('horario_id', $request->input('id'))->get();

            foreach($empleados as $empleado){
                $empleado->horario_id = null;
                $empleado->update();
            }

            $horario->delete();

            DB::commit();
        } catch(Illuminate\Database\QueryException $error){
            DB::rollback();
            return redirect()->back()->withInput()->with('error', "Hubo un error: {$error->getMessage()}");
        }
        catch(\Exception $error){
            DB::rollback();
            return redirect()->back()->withInput()->with('error', "Hubo un error: {$error->getMessage()}");
        }

        return redirect()->route('horario.index')->with('success', "Horario eliminado satisfactoriamente"); 
    }

    public function index(){
        $horarios = Horario::orderBy('created_at','desc')->paginate(10);
        return view('horario.index', [
            'horarios' => $horarios
        ]);
    }

    public function updateView($id){
        $horario = Horario::find($id);
        return view('horario.actualizar', [
            'horario' => $horario
        ]);
    }

    public function register(){
        return view('horario.create');
    }
}
