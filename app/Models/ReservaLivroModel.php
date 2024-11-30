<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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

    public function formataData($dados)
    {

        foreach ($dados as $value) {

            $value->created_at = Carbon::parse($value->created_at)->format('d/m/Y H:m:i');
            $value->updated_at = Carbon::parse($value->updated_at)->format('d/m/Y H:m:i');
        }

        return $dados;
    }

    public function pesquisarReserva($where = [])
    {

        $reserva = DB::table($this->table)
            ->join('users', 'users.id', '=', 'reserva_livro.user_id')
            ->join('status', 'status.id_status', '=', 'reserva_livro.status_id')
            ->select('reserva_livro.*', 'users.name', 'status.descricao as status')
            ->orderBy('reserva_livro.id_reserva_livro', 'desc');

        if (!empty($where)) {

            foreach ($where as $key => $value) {


                if ($key == 'id_reserva_livro') {

                    $reserva->where('reserva_livro.id_reserva_livro', '=', $value);
                }

                if ($key == 'status') {

                    $reserva->where('status.descricao', 'like', '%' . $value . '%');
                }

                if ($key == 'nome') {

                    $reserva->where('users.name', 'like', '%' . $value . '%');
                }

                if ($key == 'valor_pesquisado') {

                    //Verifica se é uma data
                    if (strpos($value, "/") !== false) {

                        $data = explode("/", $value);

                        if (count($data) == 3) {

                            $dia = $data[0];
                            $mes = $data[1];
                            $ano = $data[2];

                            $value = $ano . "-" . $mes . "-" . $dia;
                        } else if (count($data) == 2) {
                            $dia = $data[0];
                            $mes = $data[1];

                            $value = $mes . "-" . $dia;
                        } else if (count($data) == 1) {
                            $value = $data[0];
                        }

                        $reserva->orWhere('reserva_livro.created_at', 'like', "%" . $value . "%");
                        
                    } else {

                        if (is_numeric($value)) {

                            $reserva->where('reserva_livro.id_reserva_livro', '=', "" . $value . "");
                        } else {

                            $reserva->orWhere('users.name', 'like', "" . $value . "%");
                            $reserva->orWhere('status.descricao', 'like', "" . $value . "%");
                            $reserva->orWhere('reserva_livro.created_at', 'like', "%" . $value . "%");
                        }
                    }
                }
            }
        }

        $dados = $this->formataData($reserva->get());

        return $dados;
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }


    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }
}
