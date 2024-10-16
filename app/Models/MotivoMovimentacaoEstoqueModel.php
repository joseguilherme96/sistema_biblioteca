<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotivoMovimentacaoEstoqueModel extends Model
{
    use HasFactory;

    protected $table = 'motivo_movimentacao_estoque';

    protected $fillable = [
        'id_motvo_mov',
        'nome',
        'descricao',
        'created_at',
        'updated_at'
    ];
}
