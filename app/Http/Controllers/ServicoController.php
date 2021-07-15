<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\User;
use App\Funcao;
use Validator;
use Auth;

class ServicoController extends Controller
{
    public function index()
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                $servicos = Servico::all();
                return view('admin.servico.index', compact('servicos'));
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

                $servico = null;
                return view('admin.servico.form', compact('servico'), ['action' => 'store', 'method' => 'post']);
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);
        } 
        catch (\Throwable $th){
            return redirect('servico')->withErrors($th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                $validator = $this->validacao($request);

                if ($validator->fails())
                    return redirect('servico/create')->withErrors([$validator->errors()->first()])->withInput();
                else{

                    $data = $request->all();
                    Servico::create($data);
                    return redirect('servico')->withErrors(['Serviço cadastrado com sucesso.']);
                }
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']);    
        } 
        catch (\Throwable $th) {
            return redirect('servico')->withErrors($th->getMessage());
        }
    }

    public function edit($id)
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                if (Funcao::numeric($id)){

                    $servico = Servico::find($id);
                    
                    if (!is_null($servico)){
    
                        return view('admin.servico.form', compact('servico'), ['action' => 'update', 'method' => 'put']);
                    }
                }
    
                return redirect('servico')->withErrors(['Serviço inválido.']);
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']); 
        } 
        catch (\Throwable $th) {
            return redirect('servico')->withErrors($th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                if (Funcao::numeric($id)){

                    $servico = Servico::find($id);
                    
                    if (!is_null($servico)){
    
                        $validator = $this->validacao($request);
    
                        if ($validator->fails())
                            return redirect('servico/'.$servico->id.'/edit')->withErrors([$validator->errors()->first()])->withInput();
                        else{
                            
                            $data = $request->all();
                            $servico->update($data);
                            return redirect('servico')->withErrors(['Serviço alterado com sucesso.']);
                        }    
                    }
                }
    
                return redirect('servico')->withErrors(['Serviço inválido.']);
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']); 
        } 
        catch (\Throwable $th) {
            return redirect('servico')->withErrors($th->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            if (Auth::user()->id == User::ADMINISTRADOR){

                if (Funcao::numeric($id)){

                    $servico = Servico::find($id);
                    
                    if (!is_null($servico)){
                        
                        $servico->delete();
                        return redirect('servico')->withErrors(['Serviço deletado com sucesso.']);
                    }
                }
    
                return redirect('servico')->withErrors(['Serviço inválido.']);
            }

            return redirect('vistoria')->withErrors(['Usuário sem permissão.']); 
        } 
        catch (\Throwable $th) {
            return redirect('servico')->withErrors($th->getMessage());
        }
    }

    public function validacao($request){

        $regex = '/^[^(\|\]~`!%^&*=};:?><’)]*$/';

        $rules = [
            'nome' => ['required', 'min:10', 'regex:'.$regex],
            'valor' => 'required',
            'status' => 'required|in:0,1'
        ];
        $messages = [
            'nome.required' => 'O Nome é obrigatório.',
            'nome.min' => 'O Nome deve conter no minimo 10 caracteres.',
            'nome.regex' => 'O Nome não deve conter caracteres especiais.',
            'valor.required' => 'O Valor é obrigatório.',
            'status.required' => 'O Status é obrigatório.',
            'status.in' => 'Status invalido.'
        ];

        return Validator::make($request->all(), $rules, $messages);
    }
}
