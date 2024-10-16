<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReservaLivroModel extends Model
{
    use HasFactory;

    protected $table = 'reserva_livro';

    //Atribuindo colunas que podem ser salvos em massa no banco de dados
    protected $fillable = [

        'id_reserva_livro',
        'user_id',
        'status_id',
        'created_at',
        'updated_at'

    ];
}
