<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\MovimentacaoEstoqueModel;

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

    public function getSaldoLivroEstoque($where = [])
    {

        $estoque = DB::table("" . $this->table . "");
        $estoque->selectRaw('SUM(quantidade) as qtd_lvro_estqe');
        $estoque->groupBy('livro_id');


        if (!empty($where)) {

            foreach ($where as $needle => $condition) {

                if ($needle == 'livro_id') {

                    $estoque->where('livro_id', '=', $condition);
                }

                if ($needle == 'quantidade') {

                    $estoque->where('quantidade', '=', $condition);
                }

                if ($needle == 'endereco_id') {

                    $estoque->where('endereco_id', '=', $condition);
                }

                if ($needle == 'id_estoque') {

                    $estoque->where('id_estoque', '=', $condition);
                }
            }
        }

        return $estoque->get();
    }

    public function baixaQuantidadeNoEstoque($where, $quantidade, $id_motivo)
    {

        $movimentacaoEstoqueModel = new MovimentacaoEstoqueModel();
        $estoque = DB::table($this->table);
        $estoque->where('livro_id', '=', $where['livro_id']);

        $result = $estoque->get();

        $falta_reservar = $quantidade;

        //Processa baixa no estoque de acordo com a primeiro produto encontrado para baixa
        foreach ($result as $value) {

            $baixa_estoque = DB::table($this->table);
            $baixa_estoque->where('id_estoque', '=', $value->id_estoque);

            if ($falta_reservar <= $value->quantidade && $falta_reservar > 0 && $value->quantidade !== 0) {

                $baixa_estoque->decrement('quantidade', $falta_reservar);


                //Registra movimento do estoque
                $movimentacaoEstoqueModel->insert(
                    [
                        'motvo_mov_id' => $id_motivo,
                        'estoque_id'=>$value->id_estoque,
                        'quantidade_anterior' => $value->quantidade,
                        'quantidade_atual' => $value->quantidade - $falta_reservar,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                );

                //Zera a quantidade a ser reservada
                $falta_reservar = 0;
            } else if ($falta_reservar > $value->quantidade && $value->quantidade !== 0 && $falta_reservar > 0) {

                $baixa_estoque->decrement('quantidade', $value->quantidade);

                //Registra movimento do estoque
                $movimentacaoEstoqueModel->insert(
                    [
                        'motvo_mov_id' => $id_motivo,
                        'estoque_id'=>$value->id_estoque,
                        'quantidade_anterior' => $value->quantidade,
                        'quantidade_atual' => 0,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                );
                
                $falta_reservar  = $falta_reservar - $value->quantidade;
            }
        }

        if ($falta_reservar == $quantidade) {

            return ['status' => false, 'message' => "Falha ao dar baixa no estoque, livro sem saldo no estoque !"];
        } else if ($falta_reservar > 0 && $falta_reservar !== $quantidade) {

            return ['status' => false, 'message' => "Os livros foram reservados parciais !"];
        } else if ($falta_reservar == 0) {

            return ['status' => true, 'message' => "Livro baixado no estoque com sucesso !"];
        }
    }
}
