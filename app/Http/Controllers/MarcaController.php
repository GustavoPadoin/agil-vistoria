<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\User;
use App\Funcao;
use Validator;
use Auth;

class MarcaController extends Controller
{
    public function index()
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                $marcas = Marca::all();
                return view('admin.marca.index', compact('marcas'));
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

                $marca = null;
                return view('admin.marca.form', compact('marca'), ['action' => 'store', 'method' => 'post']);
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);
        } 
        catch (\Throwable $th){
            return redirect('marca')->withErrors($th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                $validator = $this->validacao($request);

                if ($validator->fails())
                    return redirect('marca/create')->withErrors([$validator->errors()->first()])->withInput();
                else{

                    $data = $request->all();
                    Marca::create($data);
                    return redirect('marca')->withErrors(['Marca cadastrada com sucesso.']);
                }
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);    
        } 
        catch (\Throwable $th) {
            return redirect('marca')->withErrors($th->getMessage());
        }
    }

    public function edit($id)
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                if (Funcao::numeric($id)){

                    $marca = Marca::find($id);
                    
                    if (!is_null($marca)){
    
                        return view('admin.marca.form', compact('marca'), ['action' => 'update', 'method' => 'put']);
                    }
                }
    
                return redirect('marca')->withErrors(['Marca inválida.']);
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);
        } 
        catch (\Throwable $th) {
            return redirect('marca')->withErrors($th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                if (Funcao::numeric($id)){

                    $marca = Marca::find($id);
                    
                    if (!is_null($marca)){
    
                        $validator = $this->validacao($request);
    
                        if ($validator->fails())
                            return redirect('marca/'.$marca->id.'/edit')->withErrors([$validator->errors()->first()])->withInput();
                        else{
                            
                            $data = $request->all();
                            $marca->update($data);
                            return redirect('marca')->withErrors(['Marca alterada com sucesso.']);
                        }    
                    }
                }
    
                return redirect('marca')->withErrors(['Marca inválida.']);
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);
        } 
        catch (\Throwable $th) {
            return redirect('marca')->withErrors($th->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                if (Funcao::numeric($id)){

                    $marca = Marca::find($id);
                    
                    if (!is_null($marca)){
                        
                        $marca->modelos()->delete();
                        $marca->delete();
                        return redirect('marca')->withErrors(['Marca deletada com sucesso.']);
                    }
                }
    
                return redirect('marca')->withErrors(['Marca inválida.']);
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);
        } 
        catch (\Throwable $th) {
            return redirect('marca')->withErrors($th->getMessage());
        }
    }

    public function validacao($request){

        $regex = '/^[^(\|\]~`!%^&*=};:?><’)]*$/';

        $rules = [
            'nome' => ['required', 'min:3', 'regex:'.$regex],
            'status' => 'required|in:0,1'
        ];
        $messages = [
            'nome.required' => 'O Nome é obrigatório.',
            'nome.min' => 'O Nome deve conter no minimo 3 caracteres.',
            'nome.regex' => 'O Nome não deve conter caracteres especiais.',
            'status.required' => 'O Status é obrigatório.',
            'status.in' => 'Status invalido.'
        ];

        return Validator::make($request->all(), $rules, $messages);
    }
}
