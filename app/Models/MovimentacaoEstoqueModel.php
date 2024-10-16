<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimentacaoEstoqueModel extends Model
{
    use HasFactory;

    protected $table = 'movimentacao_estoque';

    protected $fillable = [
        'id_movimentacao',
        'mtvo_mov_id',
        'quantidade_anterior',
        'quantidade_atual',
        'created_at',
        'updated_at'
    ];
}
