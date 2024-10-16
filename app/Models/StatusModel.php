<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusModel extends Model
{
    use HasFactory;

    protected $table = 'status';

    protected $fillable = [
        'id_status',
        'sigla',
        'descricao',
        'created_at',
        'updated_at'
    ];
}
