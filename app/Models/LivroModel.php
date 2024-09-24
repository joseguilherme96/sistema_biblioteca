<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LivroModel extends Model
{
    use HasFactory;

    protected $table = 'livro';

    //Atribuindo colunas que podem ser salvos em massa no banco de dados
    protected $fillable = [

        'id',
        'nome',
        'descricao',
        'autor',
        'categoria',
        'nme_img_cap_lvro',
        'created_at',
        'updated_at'

    ];

    public function pesquisar($where=[])
    {
        $livro = DB::table("".$this->table."");

        if (!empty($where)) {

            foreach ($where as $needle => $condition) {

                if ($needle == 'id') {

                    $livro->where('id', '=', "" . $condition . "");
                }

                if ($needle == 'nome') {

                    $livro->where('nome', '=', "" . $condition . "");
                }

                if ($needle == 'autor') {

                    $livro->where('autor', '=', "" . $condition . "");
                }

                if ($needle == 'categoria') {

                    $livro->where('categoria', '=', "" . $condition . "");
                }

                if ($needle == 'valor_pesquisado') {

                    $livro->where('id', '=', "" . $condition . "");
                    $livro->orWhere('nome', 'like', "" . $condition . "%");
                    $livro->orWhere('descricao', 'like', "" . $condition . "%");
                    $livro->orWhere('autor', 'like', "" . $condition . "%");
                }
            }
        }

        return $livro->get();
    }
}
