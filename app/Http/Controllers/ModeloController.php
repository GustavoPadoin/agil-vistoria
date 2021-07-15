<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modelo;
use App\Models\Marca;
use App\Models\User;
use App\Funcao;
use Validator;
use Auth;

class ModeloController extends Controller
{
    public function index()
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                $modelos = Modelo::all();
                return view('admin.modelo.index', compact('modelos'));
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

                $modelo = null;
                $marcas = Marca::list();
                return view('admin.modelo.form', compact('modelo', 'marcas'), ['action' => 'store', 'method' => 'post']);
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);
        } 
        catch (\Throwable $th){
            return redirect('modelo')->withErrors($th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                $validator = $this->validacao($request);

                if ($validator->fails())
                    return redirect('modelo/create')->withErrors([$validator->errors()->first()])->withInput();
                else{

                    $data = $request->all();
                    Modelo::create($data);
                    return redirect('modelo')->withErrors(['Veículo cadastrado com sucesso.']);
                }
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);    
        } 
        catch (\Throwable $th) {
            return redirect('modelo')->withErrors($th->getMessage());
        }
    }

    public function edit($id)
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                if (Funcao::numeric($id)){

                    $modelo = Modelo::find($id);
                    
                    if (!is_null($modelo)){
    
                        $marcas = Marca::list();
                        return view('admin.modelo.form', compact('modelo', 'marcas'), ['action' => 'update', 'method' => 'put']);
                    }
                }
    
                return redirect('modelo')->withErrors(['Veículo inválido.']);
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);
        } 
        catch (\Throwable $th) {
            return redirect('modelo')->withErrors($th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                if (Funcao::numeric($id)){

                    $modelo = Modelo::find($id);
                    
                    if (!is_null($modelo)){
    
                        $validator = $this->validacao($request);
    
                        if ($validator->fails())
                            return redirect('modelo/'.$modelo->id.'/edit')->withErrors([$validator->errors()->first()])->withInput();
                        else{
                            
                            $data = $request->all();
                            $modelo->update($data);
                            return redirect('modelo')->withErrors(['Veículo alterado com sucesso.']);
                        }    
                    }
                }
    
                return redirect('modelo')->withErrors(['Veículo inválido.']);
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);
        } 
        catch (\Throwable $th) {
            return redirect('modelo')->withErrors($th->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                if (Funcao::numeric($id)){

                    $modelo = Modelo::find($id);
                    
                    if (!is_null($modelo)){
                        
                        $modelo->delete();
                        return redirect('modelo')->withErrors(['Veículo deletado com sucesso.']);
                    }
                }
    
                return redirect('modelo')->withErrors(['Veículo inválido.']);
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);
        } 
        catch (\Throwable $th) {
            return redirect('modelo')->withErrors($th->getMessage());
        }
    }

    public function validacao($request){

        $regex = '/^[^(\|\]~`!%^&*=};:?><’)]*$/';

        $rules = [
            'nome' => ['required', 'min:2', 'regex:'.$regex],
            'status' => 'required|in:0,1',
            'marca_id' => 'required|numeric'
        ];
        $messages = [
            'nome.required' => 'O Nome é obrigatório.',
            'nome.min' => 'O Nome deve conter no minimo 2 caracteres.',
            'nome.regex' => 'O Nome não deve conter caracteres especiais.',
            'status.required' => 'O Status é obrigatório.',
            'status.in' => 'Status invalido.',
            'marca_id.required' => 'A Marca é obrigatória.',
            'marca_id.numeric' => 'A Marca deve conter apenas numeros.'
        ];

        return Validator::make($request->all(), $rules, $messages);
    }
}
