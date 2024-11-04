<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtendimentoItemReservaModel extends Model
{
    use HasFactory;

    protected $table = 'atendimento_item_reservado';

    protected $fillable = [
        'id_atend',
        'item_reserv_id',
        'status_id',
        'user_id',
        'quantidade_separada',
        'created_at',
        'updated_at'
    ];
}
