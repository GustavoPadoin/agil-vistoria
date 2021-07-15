<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Funcao;
use Validator;
use Auth;

class UsuarioController extends Controller
{
    public function index()
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                $usuarios = User::all();
                return view('admin.usuario.index', compact('usuarios'));
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);
        } 
        catch (\Throwable $th){
            dd($th->getMessage());
        }
    }

    public function create()
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                $usuario = null;
                return view('admin.usuario.form', compact('usuario'), ['action' => 'store', 'method' => 'post']);
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);
        } 
        catch (\Throwable $th){
            return redirect('usuario')->withErrors($th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                $validator = $this->validacao($request);

                if ($validator->fails())
                    return redirect('usuario/create')->withErrors([$validator->errors()->first()])->withInput();
                else{

                    $data = $request->all();
                    User::create($data);
                    return redirect('usuario')->withErrors(['Usuário cadastrado com sucesso.']);
                }
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);    
        } 
        catch (\Throwable $th) {
            return redirect('usuario')->withErrors($th->getMessage());
        }
    }

    public function edit($id)
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                if (Funcao::numeric($id)){

                    $usuario = User::find($id);
                    
                    if (!is_null($usuario)){
    
                        return view('admin.usuario.form', compact('usuario'), ['action' => 'update', 'method' => 'put']);
                    }
                }
    
                return redirect('usuario')->withErrors(['Usuário inválido.']);
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);
        } 
        catch (\Throwable $th) {
            return redirect('usuario')->withErrors($th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                if (Funcao::numeric($id)){

                    $usuario = User::find($id);
                    
                    if (!is_null($usuario)){
    
                        $validator = $this->validacao($request);
    
                        if ($validator->fails())
                            return redirect('usuario/'.$usuario->id.'/edit')->withErrors([$validator->errors()->first()])->withInput();
                        else{
                            
                            $data = $request->all();
                            $usuario->update($data);
                            return redirect('usuario')->withErrors(['Usuário alterado com sucesso.']);
                        }    
                    }
                }
    
                return redirect('usuario')->withErrors(['Usuário inválido.']);
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);
        } 
        catch (\Throwable $th) {
            return redirect('usuario')->withErrors($th->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                if (Funcao::numeric($id)){

                    $usuario = User::find($id);
                    
                    if (!is_null($usuario)){
                        
                        $usuario->delete();
                        return redirect('usuario')->withErrors(['Usuário deletado com sucesso.']);
                    }
                }
    
                return redirect('usuario')->withErrors(['Usuário inválido.']);
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);
        } 
        catch (\Throwable $th) {
            return redirect('usuario')->withErrors($th->getMessage());
        }
    }

    public function validacao($request){

        $regex = '/^[^(\|\]~`!%^&*=};:?><’)]*$/';

        $rules = [
            'name' => ['required', 'min:5', 'regex:'.$regex],
            'email' => 'required|email',
            'password' => ['required', 'min:8', 'regex:/(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]/'],
            'status' => 'required|in:0,1'
        ];
        $messages = [
            'name.required' => 'O Nome é obrigatório.',
            'name.min' => 'O Nome deve conter no minimo 5 caracteres.',
            'name.regex' => 'O Nome não deve conter caracteres especiais.',
            'email.required' => 'O Email é obrigatório.',
            'email.email' => 'O Email deve conter um email válido.',
            'password.required' => 'A Senha é obrigatória.',
            'password.min' => 'A Senha deve conter no minimo 8 caracteres.',
            'password.regex' => 'A Senha deve conter letras e numeros.',
            'status.required' => 'O Status é obrigatório.',
            'status.in' => 'Status invalido.'
        ];

        return Validator::make($request->all(), $rules, $messages);
    }
}
