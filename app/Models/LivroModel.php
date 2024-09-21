<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class LivroModel extends Model
{
    use HasFactory;

    protected $table = 'livro';

    //Atribuindo colunas que podem ser salvos em massa no banco de dados
    protected $fillable = [

        'id',
        'nome',
        'descricao',
        'autor',
        'categoria',
        'created_at',
        'updated_at'

    ];
}
