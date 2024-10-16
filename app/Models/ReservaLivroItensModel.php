<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
