<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function selectMovimentacaoEstoque($where = [])
    {
        $movimentacaoEstoque = DB::table('movimentacao_estoque')
            ->join('motivo_movimentacao_estoque', 'movimentacao_estoque.motvo_mov_id', '=', 'motivo_movimentacao_estoque.id_motvo_mov')
            ->join('estoque', 'movimentacao_estoque.estoque_id', '=', 'estoque.id_estoque')
            ->join('livro', 'estoque.livro_id', '=', 'livro.id')
            ->select(
                'movimentacao_estoque.id_movimentacao as ID Movimentacao',
                'motivo_movimentacao_estoque.nome as motivo',
                'livro.nome as livro',
                'movimentacao_estoque.quantidade_anterior as Quantidade antes da movimentação',
                DB::raw('movimentacao_estoque.quantidade_atual - movimentacao_estoque.quantidade_anterior as "Quantidade movimentada"'),
                'movimentacao_estoque.quantidade_atual as Quantidade depois da movimentação',
            )
            ->orderBy('movimentacao_estoque.id_movimentacao', 'desc');

        if (!empty($where)) {

            foreach ($where as $key => $value) {

                if ($key == 'id_movimentacao') {

                    $movimentacaoEstoque->where('id_movimentacao', $value);
                }

                if ($key == 'mtvo_mov_id') {

                    $movimentacaoEstoque->where('mtvo_mov_id', $value);
                }

                if ($key == 'estoque_id') {

                    $movimentacaoEstoque->where('estoque_id', $value);
                }
            }
        }

        return $movimentacaoEstoque->get();
    }
}
