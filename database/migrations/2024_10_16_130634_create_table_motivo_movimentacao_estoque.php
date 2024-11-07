<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\MotivoMovimentacaoEstoqueModel;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $motivoMovimentacaoEstoqueModel = new MotivoMovimentacaoEstoqueModel();

        Schema::create('motivo_movimentacao_estoque', function (Blueprint $table) {

            $table->integer('id_motvo_mov')->unique();
            $table->string('nome', 20)->nullable();
            $table->string('descricao', 100);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        $motivoMovimentacaoEstoqueModel->insert([
            [
                'id_motvo_mov'=>1,
                'nome' => 'Reserva',
                'descricao' => 'Reserva de livros no estoque',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_motvo_mov'=>2,
                'nome' => 'Emprestimo',
                'descricao' => 'Emprestimo de livros do estoque',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_motvo_mov'=>3,
                'nome' => 'Devolução',
                'descricao' => 'Devolução de livros do estoque',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_motvo_mov'=>4,
                'nome' => 'Perda',
                'descricao' => 'Perda de livros do estoque',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_motvo_mov'=>5,
                'nome' => 'Danificado',
                'descricao' => 'Livros danificados no estoque',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_motvo_mov'=>6,
                'nome' => 'Carga Inicial',
                'descricao' => 'Livros que entram pela primeira vez no estoque',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('motivo_movimentacao', function (Blueprint $table) {

            Schema::dropIfExists('motivo_movimentacao_estoque');
        });
    }
};
