<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NivelAcessoModel extends Model
{
    use HasFactory;

    protected $table = 'nivel_acesso';

    protected $fillable = [
        'id_nivel_acesso',
        'nome_nivel_acesso',
        'descricao_nivel_acesso',
        'created_at',
        'updated_at'
    ];
}
