<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ReservaLivroItensModel extends Model
{
    use HasFactory;

    protected $table = 'reserva_livro_itens';

    protected $fillable = [
        'id_item_reserva',
        'reserva_id',
        'livro_id',
        'quantidade_reservada',
        'created_at',
        'updated_at'
    ];

    public function formataData($dados)
    {

        foreach ($dados as $value) {

            $value->data_devolucao = Carbon::parse($value->data_devolucao)->format('d/m/Y');
        }

        return $dados;
    }

    public function pesquisarItensReservados($where = [])
    {

        $reservaLivroItens = DB::table($this->table)
            ->join('livro', 'reserva_livro_itens.livro_id', '=', 'livro.id')
            ->join('estoque', 'reserva_livro_itens.estoque_id', '=', 'estoque.id_estoque')
            ->join('endereco_livro', 'estoque.endereco_id','=','endereco_livro.id_endereco')
            ->join('atendimento_item_reservado', 'reserva_livro_itens.id_item_reserva', '=', 'atendimento_item_reservado.item_reserv_id', 'left')
            ->select('livro.*', 'reserva_livro_itens.*', 'atendimento_item_reservado.quantidade_separada','endereco_livro.descricao as endereco','atendimento_item_reservado.data_devolucao');


        if (!empty($where)) {

            foreach ($where as $key => $value) {


                if ($key == 'reserva_id') {

                    $reservaLivroItens->where('reserva_livro_itens.reserva_id', '=', $value);
                }
            }
        }

        return $this->formataData($reservaLivroItens->get());
    }
}
