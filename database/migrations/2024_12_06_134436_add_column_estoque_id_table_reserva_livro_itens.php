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
        Schema::table('reserva_livro_itens', function (Blueprint $table) {
            $table->integer('estoque_id')->unsigned()->nullable()->after('livro_id');
            $table->foreign('estoque_id')->references('id_estoque')->on('estoque');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reserva_livro_itens', function (Blueprint $table) {
           // $table->dropColumn('estoque_id');
        });
    }
};
