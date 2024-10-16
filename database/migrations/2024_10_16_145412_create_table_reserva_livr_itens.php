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
        Schema::create('reserva_livro_itens', function (Blueprint $table) {
            $table->increments('id_item_reserva');
            $table->unsignedInteger('reserva_id');
            $table->unsignedInteger('livro_id');
            $table->unsignedInteger('quantidade_reservada');
            $table->timestamp('created_at')->nullable(); 
            $table->timestamp('updated_at')->nullable(); 
            $table->foreign('reserva_id')->references('id_reserva_livro')->on('reserva_livro');
            $table->foreign('livro_id')->references('id')->on('livro');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reserva_livro_itens', function (Blueprint $table) {
            Schema::dropIfExists('reserva_livro_itens');
        });
    }
};
