<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserController extends Controller
{
    public function create(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string|max:60',
            'lastname' => 'required|string|max:60',
            'email' => 'required|string|max:100|email|unique:users,email,',
            'password' => 'required|max:255|min:8|confirmed',
            'password_confirmation'  => 'required|max:255|same:password'
        ]);

        try {
            DB::beginTransaction();

            $user = new User();

            $user->name = $request->input('name');
            $user->lastname = $request->input('lastname'); 
            $user->email = $request->input('email'); 
            $user->admin = $request->input('admin') == 1 ? true : false; 
            $password = Hash::make($request->input('password'));
        
            $user->password = $password;

            $user->save();

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
            'name' => 'required|string|max:60',
            'lastname' => 'required|string|max:60',
            'email'  => 'required|string|email|max:255|unique:users,email,'.$request->input('id'),
        ]);

        try {
            DB::beginTransaction();

            $user = User::where('id', $request->input('id'))->first();

            if(!$user){
                throw new \Exception("El usuario al que intenta acceder no se encuentra", 1);
            }

            $user->name = $request->input('name');
            $user->lastname = $request->input('lastname'); 
            $user->email = $request->input('email'); 
            $user->admin = $request->input('admin') == 1 ? true : false; 

            $user->update();

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

    public function changePassword(Request $request){
        
        $validatedData = $request->validate([
            'id' => 'required',
            'password' => 'required|max:255|min:8|confirmed',
            'password_confirmation'  => 'required|max:255|same:password'
        ]);
        
        try {
            DB::beginTransaction();
            
            $user = User::where('id', $request->input('id'))->first();

            if(!$user){
                throw new \Exception("El usuario al que intenta acceder no se encuentra", 1);
            }

            $password = Hash::make($request->input('password'));
            
            $user->password = $password;

            $user->update();

            DB::commit();
        } catch(Illuminate\Database\QueryException $error){
            DB::rollback();
            return redirect()->back()->withInput()->with('error', "Hubo un error: {$error->getMessage()}");
        }
        catch(\Exception $error){
            DB::rollback();
            return redirect()->back()->withInput()->with('error', "Hubo un error: {$error->getMessage()}");
        }

        return redirect()->back()->with('success', "Contraseña actualizada correctamente"); 
    }


    public function index(){
        $users = User::orderBy('created_at','desc')->paginate(10);
        return view('user.index', [
            'users' => $users
        ]);
    }

    public function updateView($id){
        $user = User::find($id);
        return view('user.actualizar', [
            'user' => $user
        ]);
    }
}
