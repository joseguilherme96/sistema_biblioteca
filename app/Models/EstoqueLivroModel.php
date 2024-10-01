<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstoqueLivroModel extends Model
{
    use HasFactory;

    protected $table = 'estoque';

    //Atribuindo colunas que podem ser salvos em massa no banco de dados
    protected $fillable = [

        'id_estoque',
        'livro_id',
        'endereco_id',
        'created_at',
        'updated_at'

    ];
}
