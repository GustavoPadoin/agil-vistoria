<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    const ATIVO = 1;
    
    public $timestamps = false;

    protected $fillable = [
        'id', 'nome', 'status', 'marca_id'
    ];

    public function marca(){

        return $this->belongsTo(Marca::class);
    }

    public static function list($id){

        return self::select('id', 'nome')->where('status', self::ATIVO)->where('marca_id', $id)->orderBy('nome', 'ASC')->get();
    }
}
