<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movimentacao_estoque', function (Blueprint $table) {
            //

            $table->increments('id_movimentacao');
            $table->integer('motvo_mov_id');
            $table->unsignedInteger('estoque_id');
            $table->integer('quantidade_anterior')->nullable();
            $table->integer('quantidade_atual')->nullable();
            $table->foreign('motvo_mov_id')->references('id_motvo_mov')->on('motivo_movimentacao_estoque');
            $table->foreign('estoque_id')->references('id_estoque')->on('estoque');
            $table->timestamp('created_at')->nullable(); 
            $table->timestamp('updated_at')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movimentacao_estoque', function (Blueprint $table) {
            
            Schema::dropIfExists('movimentacao_estoque');

        });
    }
};
