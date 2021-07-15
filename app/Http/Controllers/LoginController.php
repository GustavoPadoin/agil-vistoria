<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;

class LoginController extends Controller
{
    public function index(){

        return view('admin.layout.login');
    }

    public function entrar(Request $request){

        $validator = $this->validacao($request);

        if ($validator->fails()){
           return redirect('admin')->withErrors($validator->errors()->first())->withInput();
        }
        else{
            $data = $request->all();

            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => User::ATIVO])){
                return redirect()->route('vistoria.index');
            }
            else{
                return redirect('admin')->withErrors(['Não foi possível efetuar login.'])->withInput();
            }
        }
    }

    public function sair(){

        Auth::logout();
        return redirect()->route('admin');
    }

    public function validacao($request){

        $rules = [
          'email' => 'required|email',
          'password' => ['required', 'min:8', 'regex:/(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]/']
        ];
        $messages = [
           'email.required' => 'O Email é obrigatório.',
           'email.email' => 'O Email deve conter um Email válido.',
           'password.required' => 'A Senha é obrigatória.',
           'password.min' => 'A Senha deve conter no minimo 8 caracteres.',
           'password.regex' => 'A Senha deve conter letras e numeros.'
        ];

        return Validator::make($request->all(), $rules, $messages);
    }
}
