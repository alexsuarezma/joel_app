<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Producto;
use App\Models\TipoGasto;

class ProductoController extends Controller
{
    public function create(Request $request){

        $validatedData = $request->validate([
            'descripcion' => 'required|string|max:100',
            'tipo_inventario' => 'required|string|max:2',
            'tipo_producto' => 'required|string|max:2',
            'costo' => 'required|numeric',
            'precio_unitario' => 'required|numeric',
            'unidad_medida' => 'required|string|max:10',
            'factor' => 'required|numeric',
            'tipo_gasto_id' => 'required|numeric',
            'vigencia'  => 'numeric',
        ]);

        try {

            DB::beginTransaction();

            $producto = new Producto();

            $producto->descripcion = $request->input('descripcion');
            $producto->tipo_inventario = $request->input('tipo_inventario');
            $producto->tipo_producto = $request->input('tipo_producto');
            $producto->costo = $request->input('costo');
            $producto->precio_unitario = $request->input('precio_unitario');
            $producto->unidad_medida = $request->input('unidad_medida');
            $producto->factor = $request->input('factor');
            $producto->tipo_gasto_id = $request->input('tipo_gasto_id');

            $producto->save();

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
            'tipo_inventario' => 'required|string|max:2',
            'tipo_producto' => 'required|string|max:2',
            'costo' => 'required|numeric',
            'precio_unitario' => 'required|numeric',
            'unidad_medida' => 'required|string|max:10',
            'factor' => 'required|numeric',
            'tipo_gasto_id' => 'required|numeric',
            'vigencia'  => 'numeric',
        ]);

        try {
            DB::beginTransaction();

            $producto = Producto::where('id', $request->input('id'))->first();

            if(!$producto){
                throw new \Exception("El Producto al que intenta acceder no se encuentra", 1);
            }

            $producto->descripcion = $request->input('descripcion');
            $producto->tipo_inventario = $request->input('tipo_inventario');
            $producto->tipo_producto = $request->input('tipo_producto');
            $producto->costo = $request->input('costo');
            $producto->precio_unitario = $request->input('precio_unitario');
            $producto->unidad_medida = $request->input('unidad_medida');
            $producto->factor = $request->input('factor');
            $producto->tipo_gasto_id = $request->input('tipo_gasto_id');


            $producto->update();

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
        return view('admin.producto.index');
    }

    public function updateView($id){
        $producto = Producto::find($id);
        return view('admin.producto.actualizar', [
            'producto' => $producto,
            'tipo_gastos' => TipoGasto::all()
        ]);
    }

    public function register(){
        return view('admin.producto.create',[
            'tipo_gastos' => TipoGasto::all()
        ]);
    }
}
