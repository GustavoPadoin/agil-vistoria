<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cidade;
use App\Models\User;
use App\Funcao;
use Validator;
use Auth;

class CidadeController extends Controller
{
    public function index()
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                $cidades = Cidade::all();
                return view('admin.cidade.index', compact('cidades'));
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

                $cidade = null;
                return view('admin.cidade.form', compact('cidade'), ['action' => 'store', 'method' => 'post']);
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);
        } 
        catch (\Throwable $th){
            return redirect('cidade')->withErrors($th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                $validator = $this->validacao($request);

                if ($validator->fails())
                    return redirect('cidade/create')->withErrors([$validator->errors()->first()])->withInput();
                else{

                    $data = $request->all();
                    Cidade::create($data);
                    return redirect('cidade')->withErrors(['Cidade cadastrada com sucesso.']);
                }
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);    
        } 
        catch (\Throwable $th) {
            return redirect('cidade')->withErrors($th->getMessage());
        }
    }

    public function edit($id)
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                if (Funcao::numeric($id)){

                    $cidade = Cidade::find($id);
                    
                    if (!is_null($cidade)){
    
                        return view('admin.cidade.form', compact('cidade'), ['action' => 'update', 'method' => 'put']);
                    }
                }
    
                return redirect('cidade')->withErrors(['Cidade inválida.']);
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);
        } 
        catch (\Throwable $th) {
            return redirect('cidade')->withErrors($th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                if (Funcao::numeric($id)){

                    $cidade = Cidade::find($id);
                    
                    if (!is_null($cidade)){
    
                        $validator = $this->validacao($request);
    
                        if ($validator->fails())
                            return redirect('cidade/'.$cidade->id.'/edit')->withErrors([$validator->errors()->first()])->withInput();
                        else{
                            
                            $data = $request->all();
                            $cidade->update($data);
                            return redirect('cidade')->withErrors(['Cidade alterada com sucesso.']);
                        }    
                    }
                }
    
                return redirect('cidade')->withErrors(['Cidade inválida.']);
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);
        } 
        catch (\Throwable $th) {
            return redirect('cidade')->withErrors($th->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                if (Funcao::numeric($id)){

                    $cidade = Cidade::find($id);
                    
                    if (!is_null($cidade)){
                        
                        $cidade->delete();
                        return redirect('cidade')->withErrors(['Cidade deletada com sucesso.']);
                    }
                }
    
                return redirect('cidade')->withErrors(['Cidade inválida.']);
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);
        } 
        catch (\Throwable $th) {
            return redirect('cidade')->withErrors($th->getMessage());
        }
    }

    public function validacao($request){

        $regex = '/^[^(\|\]~`!%^&*=};:?><’)]*$/';

        $rules = [
            'nome' => ['required', 'min:5', 'regex:'.$regex],
            'status' => 'required|in:0,1'
        ];
        $messages = [
            'nome.required' => 'O Nome é obrigatório.',
            'nome.min' => 'O Nome deve conter no minimo 5 caracteres.',
            'nome.regex' => 'O Nome não deve conter caracteres especiais.',
            'status.required' => 'O Status é obrigatório.',
            'status.in' => 'Status invalido.'
        ];

        return Validator::make($request->all(), $rules, $messages);
    }
}
