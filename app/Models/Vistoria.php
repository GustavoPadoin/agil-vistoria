<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Funcao;
use DB;
use Auth;

class Vistoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'data', 'hora', 'placa', 'outro', 'pagamento', 'servico_id', 'modelo_id', 'cliente_id', 'cidade_id', 'data_pagamento', 'user_id'
    ];

    public function setDataAttribute($value){
        $this->attributes['data'] = Funcao::formataData($value);
    }

    //public function getDataAttribute(){
      //  return Funcao::formataDataBD($this->attributes['data']);
    //}

    public function getCreatedAtAttribute(){
        $data = explode(" ", $this->attributes['created_at']);
        return Funcao::formataDataBD($data[0]);
    }

    public function servico(){
        return $this->belongsTo(Servico::class);
    }

    public function modelo(){
        return $this->belongsTo(Modelo::class);
    }

    public function cidade(){
        return $this->belongsTo(Cidade::class);
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function verificaSeExiste($cpf, $cnpj){

        $query = Cliente::select('id');

        if (!is_null($cpf))
            $query->where('cpf', Funcao::soNumeros($cpf));

        if (!is_null($cnpj)) 
            $query->orWhere('cnpj', Funcao::soNumeros($cnpj));

        return $query->first();    
    }

    public static function getHoras($cidade, $data){

        return DB::table('vistorias')
                    ->selectRaw('DATE_FORMAT(hora,"%H:%i") AS hora')
                    ->where('cidade_id', $cidade)
                    ->where('data', Funcao::formataData2($data))->get();
    }

    public static function listagem($data_ini = null, $data_fin = null, $servico = null, $cidade = null, $pagamento = null){

        $query = DB::table('vistorias AS v') 
                  ->select('v.id', DB::raw('DATE_FORMAT(v.data,"%d/%m/%Y") AS data'), 'v.hora', 'v.pagamento', 
                            DB::raw('DATE_FORMAT(v.data_pagamento,"%d/%m/%Y") AS data_pagamento'), 
                            'c.nome AS cliente', 's.nome AS servico', 's.valor', 'ci.nome AS cidade')
                  ->join('clientes AS c', 'c.id', '=', 'v.cliente_id')
                  ->join('servicos AS s', 's.id', '=', 'v.servico_id')
                  ->join('cidades AS ci', 'ci.id', '=', 'v.cidade_id');

        if (!is_null($data_ini))
            $query->where('v.data', '>=', Funcao::formataData($data_ini));

        if (!is_null($data_fin))
            $query->where('v.data', '<=', Funcao::formataData($data_fin));
                
        if (!is_null($servico))
            $query->where('v.servico_id', $servico);

        if (!is_null($cidade))
            $query->where('v.cidade_id', $cidade);

        if (!is_null($pagamento))
            $query->where('v.pagamento', $pagamento);
        
        if (Auth::user()->id != User::ADMINISTRADOR)
            $query->where('v.user_id', Auth::user()->id);

        return $query->orderBy('v.id', 'DESC')->get();
    }
}
