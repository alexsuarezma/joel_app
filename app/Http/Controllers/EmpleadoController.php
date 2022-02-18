<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Empleado;
// use App\Models\Horario;

class EmpleadoController extends Controller
{
    public function create(Request $request){

        $validatedData = $request->validate([
            'cedula' => 'required|numeric|unique:empleados|between:0000000000,9999999999',
            'nombres' => 'required|string|max:60',
            'apellidos' => 'required|string|max:60',
            'salario' => 'required|string|max:60',
            'actividad' => 'required|string|max:60',
            'email' => 'required|string|max:100|email|unique:users,email,',
            'direccion' => 'required|max:255',
            'fecha_ingreso'  => 'required'
        ]);

        try {
            DB::beginTransaction();

            if(!$this->validateCedula($request->input('cedula'))){
                throw new \Exception("La cedula {$request->input('cedula')} no es válida.", 1);
            }

            $empleado = new Empleado();

            $empleado->cedula = $request->input('cedula');
            $empleado->nombres = $request->input('nombres'); 
            $empleado->apellidos = $request->input('apellidos'); 
            $empleado->email = $request->input('email'); 
            $empleado->direccion = $request->input('direccion'); 
            $empleado->salario = $request->input('salario'); 
            $empleado->actividad = $request->input('actividad'); 
            // $empleado->horario_id = $request->input('horario_id'); 
            $empleado->fecha_ingreso = $request->input('fecha_ingreso'); 

            $empleado->save();

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
            'cedula' => 'required|numeric|between:0000000000,9999999999|unique:empleados,cedula,'.$request->input('id'),
            'nombres' => 'required|string|max:60',
            'apellidos' => 'required|string|max:60',
            'email' => 'required|string|max:100|email|unique:empleados,email,'.$request->input('id'),
            'direccion' => 'required|max:255',
            'salario' => 'required|string|max:60',
            'actividad' => 'required|string|max:60',
            'fecha_ingreso'  => 'required|date'
        ]);

        try {
            DB::beginTransaction();

            $empleado = Empleado::where('id', $request->input('id'))->first();

            if(!$empleado){
                throw new \Exception("El empleado al que intenta acceder no se encuentra", 1);
            }

            // $horarioHasEmpleado = HorarioHasEmpleado::where('empleado_id', $request->input('id'))
            //                                     ->where('horario_id', )

            $empleado->cedula = $request->input('cedula');
            $empleado->nombres = $request->input('nombres'); 
            $empleado->apellidos = $request->input('apellidos'); 
            $empleado->email = $request->input('email'); 
            $empleado->direccion = $request->input('direccion'); 
            $empleado->salario = $request->input('salario'); 
            $empleado->actividad = $request->input('actividad'); 
            // $empleado->horario_id = $request->input('horario_id'); 
            $empleado->fecha_ingreso = $request->input('fecha_ingreso'); 

            $empleado->update();

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
        $empleados = Empleado::orderBy('created_at','desc')->paginate(10);
        return view('empleado.index', [
            'empleados' => $empleados
        ]);
    }

    public function updateView($id){
        $empleado = Empleado::find($id);
        return view('empleado.actualizar', [
            'empleado' => $empleado,
            // 'horarios' => Horario::all()
        ]);
    }

    public function register(){
        return view('empleado.create',[
            // 'horarios' => Horario::all()
        ]);
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
