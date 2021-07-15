<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VistoriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $regex = '/^[^(\|\]~`!%^&*=};:?><’)]*$/';

        return [
            'servico_id' => 'required|numeric',
            'data' => 'required',
            'hora' => 'required|date_format:H:i',
            'marca_id' => 'required|numeric',
            'modelo_id' => 'nullable|numeric',
            'outro' => ['nullable', 'min:4', 'regex:'.$regex],
            'placa' => 'required|placa',
            'cidade_id' => 'required|numeric',
            'nome' => ['required', 'min: 4', 'regex:'.$regex],
            'cpf' => 'nullable|cpf',
            'cnpj' => 'nullable|cnpj',
            'telefone' => 'required',
            'email' => 'required|email'
        ];
    }

    public function messages(){

        return [
            'servico_id.required' => 'O Serviço é obrigatório.',
            'servico_id.numeric' => 'O Serviço deve conter apenas numeros.',
            'data.required' => 'A Data é obrigatória.',
            'hora.required' => 'A Hora é obrigatória.',
            'hora.date_format' => 'A Hora deve conter uma hora válida.',
            'marca_id.required' => 'A Marca é obrigatória.',
            'marca_id.numeric' => 'A Marca deve conter apenas numeros.',
            'modelo_id.numeric' => 'O Modelo deve conter apenas numeros.',
            'outro.min' => 'Outro deve conter no minimo 4 caracteres.',
            'outro.regex' => 'Outro não deve conter caracteres especiais.',
            'placa.required' => 'A Placa é obrigatória.',
            'placa.placa' => 'A Placa deve conter uma Placa válida.',
            'cidade_id.required' => 'A Cidade é obrigatória.',
            'cidade_id.numeric' => 'A Cidade deve conter apenas numeros.',
            'nome.required' => 'O Nome é obrigatório.',
            'nome.min' => 'O Nome deve conter no minimo 4 caracteres.',
            'nome.regex' => 'O Nome não deve conter caracteres especiais.',
            'cpf.cpf' => 'O CPF deve conter um CPF válido.',
            'cnpj.cnpj' => 'O CNPJ deve conter um CNPJ válido.',
            'telefone.required' => 'O Telefone é obrigatório.',
            'email.required' => 'O Email é obrigatório.',
            'email.email' => 'O Email deve conter um Email válido.'
        ];
    }
}
