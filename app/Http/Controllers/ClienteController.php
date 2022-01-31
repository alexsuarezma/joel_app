<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Cliente;

class ClienteController extends Controller
{
    public function create(Request $request){

        $validatedData = $request->validate([
            'tipo_cliente'  => 'required|numeric',
            'cedula' => 'required|numeric|unique:clientes|between:0000000000,9999999999',
            'nombres' => 'required|string|max:60',
            'apellidos' => 'required|string|max:60',
            'email' => 'required|string|max:100|email|unique:users,email,',
            'direccion' => 'required|max:255',
            'telefono'  => 'required|numeric|between:0000000000,9999999999',
            'celular'  => 'required|numeric|between:0000000000,9999999999',
        ]);

        try {
            DB::beginTransaction();

            if(!$this->validateCedula($request->input('cedula'))){
                throw new \Exception("La cedula {$request->input('cedula')} no es válida.", 1);
            }

            $cliente = new Cliente();

            $cliente->tipo_cliente = $request->input('tipo_cliente');
            $cliente->cedula = $request->input('cedula');
            $cliente->nombres = $request->input('nombres'); 
            $cliente->apellidos = $request->input('apellidos'); 
            $cliente->email = $request->input('email'); 
            $cliente->direccion = $request->input('direccion'); 
            $cliente->telefono = $request->input('telefono'); 
            $cliente->celular = $request->input('celular'); 

            $cliente->save();

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
            'tipo_cliente'  => 'required|numeric',
            'cedula' => 'required|numeric|between:0000000000,9999999999|unique:clientes,cedula,'.$request->input('id'),
            'nombres' => 'required|string|max:60',
            'apellidos' => 'required|string|max:60',
            'email' => 'required|string|max:100|email|unique:users,email,',
            'direccion' => 'required|max:255',
            'telefono'  => 'required|numeric|between:0000000000,9999999999',
            'celular'  => 'required|numeric|between:0000000000,9999999999',
        ]);

        try {
            DB::beginTransaction();

            $cliente = Cliente::where('id', $request->input('id'))->first();

            if(!$cliente){
                throw new \Exception("El cliente al que intenta acceder no se encuentra", 1);
            }

            $cliente->tipo_cliente = $request->input('tipo_cliente');
            $cliente->cedula = $request->input('cedula');
            $cliente->nombres = $request->input('nombres'); 
            $cliente->apellidos = $request->input('apellidos'); 
            $cliente->email = $request->input('email'); 
            $cliente->direccion = $request->input('direccion'); 
            $cliente->telefono = $request->input('telefono'); 
            $cliente->celular = $request->input('celular'); 

            $cliente->update();

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
        $clientes = Cliente::orderBy('created_at','desc')->paginate(10);
        return view('cliente.index');
    }

    public function updateView($id){
        $cliente = Cliente::find($id);
        return view('cliente.actualizar', [
            'cliente' => $cliente
        ]);
    }

    public function register(){
        return view('cliente.create');
    }


    private function validateCedula($cedula){
        $digitoVerificador = substr($cedula, 9, 1);
    
        if(strlen($cedula) == 10){
            $numero = 0;
            $suma = 0;
            $residuoSuma = 0;
    
            for($i=0; $i<(strlen($cedula) - 1); $i++){
                $numero = substr($cedula, $i, 1);
    
                ($i%2 == 0) ? $numero = $numero * 2 : $numero = $numero * 1;
    
                ($numero > 9) ? $numero = $numero - 9 : '' ;
    
                $suma+=$numero;
                $numero = 0;
            }
    
            $residuoSuma = $suma % 10;
    
            if($residuoSuma == 0){
                if($residuoSuma == $digitoVerificador){
                    return true;
                }else{
                    return false;
                }
            }else{
                $residuoSuma = 10 - $residuoSuma;
    
                if($residuoSuma == $digitoVerificador){
                    return true;
                }else{
                    return false;
                }
            }
        }
    
        return false;
    }
}
