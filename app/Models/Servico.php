<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Funcao;

class Servico extends Model
{
    use HasFactory;

    public $timestamps = FALSE;

    const ATIVO = 1;
    
    protected $fillable = [
        'nome', 'valor', 'status'
    ];
    
    public function setValorAttribute($valor){
        $this->attributes['valor'] = Funcao::formataMoeda($valor);
    }

    public function getValorAttribute(){
        return Funcao::formataMoedaBD($this->attributes['valor']);
    }

    public static function list(){
        
        return self::select('id', 'nome', 'valor')->where('status', self::ATIVO)->get();
    }
}
