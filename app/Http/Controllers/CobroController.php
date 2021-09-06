<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Cobro;
use App\Models\Cliente;

class CobroController extends Controller
{
    public function create(Request $request){

        $validatedData = $request->validate([
            'cliente_id' => 'required|numeric',
            'descripcion' => 'required|string|max:160',
            'direccion' => 'required|string|max:160',
            'coste' => 'required|',
            'fecha'  => 'required|date'
        ]);

        try {
            DB::beginTransaction();
            
            $cliente = Cliente::select('id')->where('id', $request->input('cliente_id'))->first();

            if(!$cliente){
                throw new \Exception("El cliente al que intenta acceder no se encuentra", 1);
            }

            $cobro = new Cobro();

            $cobro->usuario_id = \Auth::user()->id;
            $cobro->cliente_id = $request->input('cliente_id'); 
            $cobro->descripcion = $request->input('descripcion'); 
            $cobro->direccion = $request->input('direccion'); 
            $cobro->coste = $request->input('coste'); 
            $cobro->fecha = $request->input('fecha'); 

            $cobro->save();

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
            'cliente_id' => 'required|numeric',
            'descripcion' => 'required|string|max:160',
            'direccion' => 'required|string|max:160',
            'coste' => 'required|',
            'fecha'  => 'required|date'
        ]);

        try {
            DB::beginTransaction();

            $cliente = Cliente::select('id')->where('id', $request->input('cliente_id'))->first();

            if(!$cliente){
                throw new \Exception("El cliente al que intenta acceder no se encuentra", 1);
            }

            $cobro = Cobro::where('id', $request->input('id'))->first();
            
            if(!$cobro){
                throw new \Exception("El cobro al que intenta acceder no se encuentra", 1);
            }

            $cobro->usuario_id = \Auth::user()->id;
            $cobro->cliente_id = $request->input('cliente_id'); 
            $cobro->descripcion = $request->input('descripcion'); 
            $cobro->direccion = $request->input('direccion'); 
            $cobro->coste = $request->input('coste'); 
            $cobro->fecha = $request->input('fecha'); 

            $cobro->update();

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

            $cobro = Cobro::where('id', $request->input('id'))->first();
            
            if(!$cobro){
                throw new \Exception("El cobro al que intenta acceder no se encuentra", 1);
            }
            $cobro->delete();

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
        $cobros = Cobro::orderBy('created_at','desc')->paginate(10);
        return view('cobro.index', [
            'cobros' => $cobros
        ]);
    }

    public function updateView($id){
        $cobro = Cobro::find($id);
        return view('cobro.actualizar', [
            'cobro' => $cobro
        ]);
    }

    public function register(){
        return view('cobro.create',[
            'clientes' => Cliente::all()
        ]);
    }
}
