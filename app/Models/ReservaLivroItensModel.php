<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function pesquisarItensReservados($where = [])
    {

        $reservaLivroItens = DB::table($this->table)
            ->join('livro', 'reserva_livro_itens.livro_id', '=', 'livro.id')
            ->join('atendimento_item_reservado', 'reserva_livro_itens.id_item_reserva', '=', 'atendimento_item_reservado.item_reserv_id','left')
            ->select('livro.*','reserva_livro_itens.*','atendimento_item_reservado.quantidade_separada');


        if (!empty($where)) {

            foreach ($where as $key => $value) {


                if ($key == 'reserva_id') {

                    $reservaLivroItens->where('reserva_livro_itens.reserva_id', '=', $value);
                }
            }
        }

        return $reservaLivroItens->get();
    }
}
