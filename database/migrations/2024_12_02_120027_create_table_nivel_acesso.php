<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\NivelAcessoModel;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nivel_acesso', function (Blueprint $table) {
            $table->integer('id_nivel_acesso')->unique();
            $table->string('nome_nivel_acesso', 45)->unique();
            $table->string('descricao_nivel_acesso', 255)->nullable();
        });

        $nivelAcessoModel = new NivelAcessoModel();

        $nivelAcessoModel->insert([
            [
                'id_nivel_acesso'=>1,
                'nome_nivel_acesso' => 'Tipo 1',
                'descricao_nivel_acesso' => 'Usuário master, que acessa todos os recursos do sistema'
            ],
            [
                'id_nivel_acesso'=>2,
                'nome_nivel_acesso' => 'Tipo 2',
                'descricao_nivel_acesso' => 'Usuários communs que acessa apenas recursos do sistema que permite realizar reservar livros.'
            ],
            [
                'id_nivel_acesso'=>3,
                'nome_nivel_acesso' => 'Tipo 3',
                'descricao_nivel_acesso' => 'Usuários do sistema que podem apenas acessar telas de cadastro e realizar reservas.'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nivel_acesso', function (Blueprint $table) {

            Schema::dropIfExists('nivel_acesso');
        });
    }
};
