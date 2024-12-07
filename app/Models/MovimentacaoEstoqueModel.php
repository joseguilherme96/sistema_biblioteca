<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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

    public function formataData($dados)
    {

        foreach ($dados as $key => $value) {


            //Tranformando objeto em array devido algumas colunas estarem com nome diferente dificultando o acesso
            $transform = array_values((array) $value);

            $transform[8] = Carbon::parse($transform[8])->format('d/m/Y H:m:i');

            //Voltando o array para um objeto
            $dados[$key] = (object) [
                "ID Estoque" => $transform[0],
                "id_movimentacao" => $transform[1],
                "Motivo" => $transform[2],
                "Livro" => $transform[3],
                "Endereço" => $transform[4],
                "Quantidade antes da movimentação" => $transform[5],
                "Quantidade movimentada" => $transform[6],
                "Quantidade depois da movimentação" => $transform[7],
                "Data de criação" => $transform[8]
            ];
        }

        return $dados;
    }

    public function selectMovimentacaoEstoque($where = [])
    {
        $movimentacaoEstoque = DB::table('movimentacao_estoque')
            ->join('motivo_movimentacao_estoque', 'movimentacao_estoque.motvo_mov_id', '=', 'motivo_movimentacao_estoque.id_motvo_mov')
            ->join('estoque', 'movimentacao_estoque.estoque_id', '=', 'estoque.id_estoque')
            ->join('endereco_livro', 'estoque.endereco_id', '=', 'endereco_livro.id_endereco')
            ->join('livro', 'estoque.livro_id', '=', 'livro.id')
            ->select(
                'estoque.id_estoque as ID Estoque',
                'movimentacao_estoque.id_movimentacao',
                'motivo_movimentacao_estoque.nome as motivo',
                'livro.nome as livro',
                'endereco_livro.descricao as endereco',
                'movimentacao_estoque.quantidade_anterior as Quantidade antes da movimentação',
                DB::raw('movimentacao_estoque.quantidade_atual - movimentacao_estoque.quantidade_anterior as "Quantidade movimentada"'),
                'movimentacao_estoque.quantidade_atual as Quantidade depois da movimentação',
                'movimentacao_estoque.created_at as Data de criação'
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

                if ($key == 'ids_movimentacao') {
                    $movimentacaoEstoque->whereIn('id_movimentacao', $value);
                }
            }
        }

        $dados = $this->formataData($movimentacaoEstoque->get());

        return $dados;
    }
}
