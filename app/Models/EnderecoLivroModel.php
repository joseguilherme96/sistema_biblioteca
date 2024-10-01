<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EnderecoLivroModel extends Model
{
    use HasFactory;

    protected $table = 'endereco_livro';

    //Atribuindo colunas que podem ser salvos em massa no banco de dados
    protected $fillable = [

        'id_endereco',
        'descricao',
        'created_at',
        'updated_at'

    ];

    public function pesquisar($where=[])
    {
        $endereco = DB::table("".$this->table."");

        if (!empty($where)) {

            foreach ($where as $needle => $condition) {

                if ($needle == 'id_endereco') {

                    $endereco->where('id_endereco', '=', "" . $condition . "");
                }

                if ($needle == 'descricao') {

                    $endereco->where('descricao', '=', "" . $condition . "");
                }

                if ($needle == 'created_at') {

                    $endereco->where('created_at', '=', "" . $condition . "");
                }

                if ($needle == 'updated_at') {

                    $endereco->where('updated_at', '=', "" . $condition . "");
                }

                if ($needle == 'valor_pesquisado') {

                    $endereco->orWhere('descricao', 'like', "" . $condition . "%");

                }
            }
        }

        return $endereco->get();
    }

}
