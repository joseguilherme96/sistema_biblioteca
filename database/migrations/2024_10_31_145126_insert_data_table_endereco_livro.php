<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\EnderecoLivroModel;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('endereco_livro', function (Blueprint $table) {
            //
        });

        $enderecoLivroModel = new EnderecoLivroModel();

        $enderecoLivroModel->insert(

            [
                [
                    'descricao' => 'Prateleira R1.P2.P.2'
                ],
                [
                    'descricao' => 'Prateleira R1.P2.P.3'
                ],
                [
                    'descricao' => 'Prateleira R1.P2.P.4'
                ],
                [
                    'descricao' => 'Prateleira R1.P2.P.5'
                ]
            ]


        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('endereco_livro', function (Blueprint $table) {
            Schema::dropIfExists('endereco_livro');
        });
    }
};
