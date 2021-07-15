<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    
    const ATIVO = 1;

    public $timestamps = false;

    protected $fillable = [
        'id', 'nome', 'status'
    ];

    public function modelos(){

        return $this->hasMany(Modelo::class);
    }

    public static function list(){

        return self::select('id', 'nome')->where('status', self::ATIVO)->orderBy('nome', 'ASC')->get();
    }
}
