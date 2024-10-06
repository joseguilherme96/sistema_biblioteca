<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
}
