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
        Schema::create('endereco_livro', function (Blueprint $table) {
            $table->increments('id_endereco');
            $table->string('descricao',50);
        });
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
