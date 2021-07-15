<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Funcao;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'cpf', 'cnpj', 'telefone', 'email'
    ];

    public function setCpfAttribute($value){
        $this->attributes['cpf'] = (!is_null($value)) ? Funcao::soNumeros($value) : null;
    }

    public function setCnpjAttribute($value){
        $this->attributes['cnpj'] = (!is_null($value)) ? Funcao::soNumeros($value) : null;
    }

    public function setTelefoneAttribute($value){
        $this->attributes['telefone'] = Funcao::soNumeros($value);
    }

    public function getCpfAttribute(){
        $cpf = $this->attributes['cpf'];
        return (!is_null($cpf)) ? Funcao::formataCpf($cpf) : null;
    }

    public function getCnpjAttribute(){
        $cnpj = $this->attributes['cnpj'];
        return (!is_null($cnpj)) ? Funcao::formataCnpj($cnpj) : null;
    }

    public function getTelefoneAttribute(){
        return Funcao::formataTelefone($this->attributes['telefone']);
    }
}