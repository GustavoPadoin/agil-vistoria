<?php

namespace App\Http\Controllers;

//use App\Http\Requests\VistoriaRequest;
use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Vistoria;
use App\Models\Cliente;
use App\Models\Cidade;
use App\Funcao;
use App\Email;
use Validator;

class SiteController extends Controller
{
    public function index()
    {
        try{
            $servicos = Servico::list();
            $marcas = Marca::list();
            $cidades = Cidade::list();

            return view('index', compact('servicos', 'marcas', 'cidades'));
        }
        catch (\Throwable $e) {
        
            return redirect('')->withErrors($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try{
            $validator = $this->validacao($request);

            if ($validator->fails())
                return response()->json(['e' => true, 'm' => $validator->errors()->first()]);
            else{
                $data = $request->all();
         
                if ( (is_null($data['cpf'])) && (is_null($data['cnpj'])) )
                    return response()->json(['e' => true, 'm' => 'Selecione o CPF ou CNPJ.']);
                else{

                    $servico = Servico::find($data['servico_id']);

                    if (is_null($servico))
                        return response()->json(['e' => true, 'm' => 'Cod. do Serviço inválido.']);
                    else{

                        $marca = Marca::find($data['marca_id']);

                        if (is_null($marca))
                            return response()->json(['e' => true, 'm' => 'Cod. da Marca inválido.']);
                        else{

                            $cidade = Cidade::find($data['cidade_id']);

                            if (is_null($cidade))
                                return response()->json(['e' => true, 'm' => 'Cod. da Cidade inválido.']);
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
                                $vis = Vistoria::create($vistoria);

                                Email::send($vis);

                                return response()->json(['e' => false, 
                                    'm' => 'Vistoria agendada com sucesso.<br/> 
                                            Obrigado por realizar o agendamento.<br/>
                                            No dia da vistoria não se esqueça de trazer a CNH e Documento do Veiculo.'
                                        ]
                                    );
                            }    
                        }    
                    }    
                }
            }        
        } 
        catch (\Throwable $e) {
            return response()->json(['e' => true, 'm' => $e->getMessage()]);
        }
    }

    public function carros(Request $request)
    {
        try{
            $id = $request->id;

            if (Funcao::numeric($id)){

                $modelos = Modelo::list($id);

                if (!is_null($modelos)){
                    return response()->json(['modelos' => $modelos]);
                }
            }
        }
        catch (\Throwable $th) {
            return response()->json(['modelos' => false]);
        }
    }

    public function horarios(Request $request){

        try{
            $data = $request->all();
              
            $horas = $this->getHoras($data['dia']);
               
            $vistorias = Vistoria::getHoras($data['cidade'], $data['data']);

            foreach ($vistorias as $vistoria){
                
                unset($horas[ltrim($vistoria->hora, "0")]);
            }

            return response()->json(['horas' => $horas]);
        } 
        catch (\Throwable $th) {
            return response()->json(['horas' => false]);
        }
    }


    public function getHoras($dia){
            
        $horas = [];

        if ($dia != "Sunday"){

            $max = ($dia == "Saturday") ? 13 : 18;

            for ($i = 8; $i < $max; $i++){
                    
                for ($j = 0; $j < 6; $j++){

                    $horas[$i.':'.$j.'0'] = $i.':'.$j.'0';
                }
            }
        }
        return $horas;
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
}