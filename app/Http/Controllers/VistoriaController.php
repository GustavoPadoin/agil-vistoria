<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\Marca;
use App\Models\Cidade;
use App\Models\Vistoria;
use App\Models\User;
use App\Models\Cliente;
use App\Funcao;
use Validator;
use Auth;

class VistoriaController extends Controller
{
    public function index(Request $request){

        try{
            $servicos = Servico::list();
            $cidades = Cidade::list();

            $data = $request->all();

            if (count($data) > 0)
                $vistorias = Vistoria::listagem($data['data_ini'], $data['data_fin'], $data['servico_id'], $data['cidade_id'], $data['pagamento']);
            else
                $vistorias = Vistoria::listagem();

            return view('admin.vistoria.index', compact('servicos', 'cidades', 'vistorias'));
        }
        catch (\Throwable $th){
            dd($th->getMessage());
        }
    }

    public function create(){

        try{
            $vistoria = null;
            $servicos = Servico::list();
            $marcas = Marca::list();
            $cidades = Cidade::list();

            return view('admin.vistoria.form', compact('vistoria', 'servicos', 'marcas', 'cidades'), ['action' => 'store', 'method' => 'post']);
        }
        catch (\Throwable $th) {
            return redirect('vistoria')->withErrors([$th->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try{
            $validator = $this->validacao($request);

            if ($validator->fails())
                return redirect('vistoria/create')->withErrors([$validator->errors()->first()])->withInput();
            else{
                $data = $request->all();
         
                if ( (is_null($data['cpf'])) && (is_null($data['cnpj'])) )
                    return  redirect('vistoria/create')->withErrors(['Selecione o CPF ou CNPJ.'])->withInput();
                else{

                    $servico = Servico::find($data['servico_id']);

                    if (is_null($servico))
                        return redirect('vistoria/create')->withErrors(['Cod. do Serviço inválido.'])->withInput();
                    else{

                        $marca = Marca::find($data['marca_id']);

                        if (is_null($marca))
                            return redirect('vistoria/create')->withErrors(['Cod. da Marca inválido.'])->withInput();
                        else{

                            $cidade = Cidade::find($data['cidade_id']);

                            if (is_null($cidade))
                                return redirect('vistoria/create')->withErrors(['Cod. da Cidade inválido.'])->withInput();
                            else{

                                $vistoria = array_slice($data, 1, 9);
                                $cliente = array_slice($data, 10, 5);
                            
                                $cli = Vistoria::verificaSeExiste($cliente['cpf'], $cliente['cnpj']);

                                if (is_null($cli)){
                                    $cli = Cliente::create($cliente);
                                }
                                else{
                                    $cli->update($cliente);
                                }
                
                                $vistoria['cliente_id'] = $cli->id;
                                $vistoria['user_id'] = Auth::user()->id;
                                $vis = Vistoria::create($vistoria);
                                return redirect()->route('vistoria.index')->withErrors(['Vistoria Agendada com sucesso.']);
                            }    
                        }    
                    }    
                }
            }        
        } 
        catch (\Throwable $e) {
            return redirect('vistoria')->withErrors([$e->getMessage()]);
        }
    }

    public function filtro(Request $request){

        try{
            $validator = $this->validacaoFiltro($request);

            if ($validator->fails())
                return redirect('vistoria')->withErrors([$validator->errors()->first()]);
            else
                return $this->index($request);
        } 
        catch (\Throwable $th) {
            return redirect('vistoria')->withErrors([$th->getMessage()]);
        }
    }

    public function edit($id){

        try{
            if (Funcao::numeric($id)){

                $vistoria = Vistoria::find($id);

                if (!is_null($vistoria)){

                    if ( ($vistoria->pagamento == 2) && (is_null($vistoria->data_pagamento)) ){

                        $user = Auth::user()->id;

                        if ( ($user == User::ADMINISTRADOR) || ($user == $vistoria->user_id) ){
                            
                            $vistoria->data_pagamento = date('Y-m-d');
                            $vistoria->update();
                            return redirect('vistoria')->withErrors(['Pagamento confirmado.']);
                        }
                    }
                }
            }
            return redirect('vistoria')->withErrors(['Vistoria inválida.']);
        } 
        catch (\Throwable $th) {
            return redirect('vistoria')->withErrors([$th->getMessage()]);
        }
    }

    public function show($id){

        try{
            if (Funcao::numeric($id)){
                
                $vistoria = Vistoria::find($id);

                if (!is_null($vistoria)){

                    $user = Auth::user()->id;

                    if ( ($user == User::ADMINISTRADOR) || ($user == $vistoria->user_id) ){

                        return view('admin.vistoria.show', compact('vistoria'));
                    }
                }
            }

            return redirect('vistoria')->withErrors(['Vistoria inválida.']);
        }
        catch (\Throwable $th) {
            return redirect('vistoria')->withErrors([$th->getMessage()]);
        }
    }

    public function destroy($id){

        try{
            if (Funcao::numeric($id)){

                $vistoria = Vistoria::find($id);

                if (!is_null($vistoria)){

                    $user = Auth::user()->id;

                    if ( ($user == User::ADMINISTRADOR) || ($user == $vistoria->user_id) ){

                        $vistoria->delete();
                        return redirect('vistoria')->withErrors(['Vistoria deletada com sucesso.']);
                    }
                }
            }

            return redirect('vistoria')->withErrors(['Vistoria inválida.']);
        }
        catch (\Throwable $th) {
            return redirect('vistoria')->withErrors([$th->getMessage()]);
        }
    }

    public function validacao($request){

        $regex = '/^[^(\|\]~`!%^&*=};:?><’)]*$/';

        $rules = [
            'servico_id' => 'required|numeric',
            'cidade_id' => 'required|numeric',
            'data' => 'required',
            'hora' => 'required',
            'marca_id' => 'required|numeric',
            'modelo_id' => 'nullable|numeric',
            'outro' => ['nullable', 'min:4', 'regex:'.$regex],
            'placa' => 'required|placa',
            'pagamento' => 'required|in:1,2',
            'nome' => ['required', 'min: 4', 'regex:'.$regex],
            'cpf' => 'nullable|cpf',
            'cnpj' => 'nullable|cnpj',
            'telefone' => 'required',
            'email' => 'required|email'
        ];

        $messages = [
            'servico_id.required' => 'O Serviço é obrigatório.',
            'servico_id.numeric' => 'O Serviço deve conter apenas numeros.',
            'cidade_id.required' => 'A Cidade é obrigatória.',
            'cidade_id.numeric' => 'A Cidade deve conter apenas numeros.',
            'data.required' => 'A Data é obrigatória.',
            'hora.required' => 'A Hora é obrigatória.',
            'marca_id.required' => 'A Marca é obrigatória.',
            'marca_id.numeric' => 'A Marca deve conter apenas numeros.',
            'modelo_id.numeric' => 'O Modelo deve conter apenas numeros.',
            'outro.min' => 'Outro deve conter no minimo 4 caracteres.',
            'outro.regex' => 'Outro não deve conter caracteres especiais.',
            'placa.required' => 'A Placa é obrigatória.',
            'placa.placa' => 'A Placa deve conter uma Placa válida.',
            'pagamento.required' => 'O Pagamento é obrigatório.',
            'pagamento.in' => 'Pagamento inválido.',
            'nome.required' => 'O Nome é obrigatório.',
            'nome.min' => 'O Nome deve conter no minimo 4 caracteres.',
            'nome.regex' => 'O Nome não deve conter caracteres especiais.',
            'cpf.cpf' => 'O CPF deve conter um CPF válido.',
            'cnpj.cnpj' => 'O CNPJ deve conter um CNPJ válido.',
            'telefone.required' => 'O Telefone é obrigatório.',
            'email.required' => 'O Email é obrigatório.',
            'email.email' => 'O Email deve conter um Email válido.'
        ];

        return Validator::make($request->all(), $rules, $messages);
    }

    public function validacaoFiltro($request){

        $rules = [
            'servico_id' => 'nullable|numeric',
            'cidade_id' => 'nullable|numeric',
            'pagamento' => 'nullable|in:1,2'
        ];

        $messages = [
            'servico_id.numeric' => 'O Serviço deve conter apenas numeros.',
            'cidade_id.numeric' => 'A Cidade deve conter apenas numeros.',
            'pagamento.in' => 'Pagamento inválido.'
        ];

        return Validator::make($request->all(), $rules, $messages);
    }
}