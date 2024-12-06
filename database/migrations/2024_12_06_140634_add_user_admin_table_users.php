<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $userModel = new User();

        $userModel->insert([

            [
                'name' => 'Admin',
                'email' => 'admin@sistema.biblioteca.com.br',
                'password' => Hash::make('*531nn22n44Ab'),
                'nivel_acesso_id' => 1
            ],

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
