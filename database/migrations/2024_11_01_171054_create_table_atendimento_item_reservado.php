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
        Schema::create('atendimento_item_reservado', function (Blueprint $table) {
            $table->increments('id_atend');
            $table->unsignedInteger('item_reserv_id');
            $table->integer('status_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('quantidade_separada')->nullable();
            $table->foreign('item_reserv_id')->references('id_item_reserva')->on('reserva_livro_itens');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id_status')->on('status');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('atendimento_item_reservado', function (Blueprint $table) {
            Schema::dropIfExists('atendimento_item_reservado');
        });
    }
};
