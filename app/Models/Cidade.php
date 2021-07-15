<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;

    public $timestamps = FALSE;

    const ATIVO = 1;
    
    protected $fillable = [
        'nome', 'status'
    ];

    public static function list(){
        
        return self::select('id', 'nome')->where('status', self::ATIVO)->orderBy('nome', 'ASC')->get();
    }
}
