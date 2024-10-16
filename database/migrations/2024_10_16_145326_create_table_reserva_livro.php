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
        Schema::create('reserva_livro', function (Blueprint $table) {
            $table->increments('id_reserva_livro');
            $table->unsignedBigInteger('user_id');
            $table->integer('status_id');
            $table->timestamp('created_at')->nullable(); 
            $table->timestamp('updated_at')->nullable(); 
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id_status')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reserva_livro', function (Blueprint $table) {
            
            Schema::dropIfExists('reserva_livro');
        });
    }
};
