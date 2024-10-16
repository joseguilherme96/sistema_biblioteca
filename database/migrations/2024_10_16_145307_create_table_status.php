
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\StatusModel;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $statusModel = new StatusModel();

        Schema::create('status', function (Blueprint $table) {
            $table->integer('id_status')->unique();
            $table->string('sigla',5);
            $table->string('descricao', 50);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        $statusModel->insert([
            [
                'id_status' => 1,
                'sigla' => 'OK',
                'descricao' => 'OK',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_status' => 2,
                'sigla' => 'CA',
                'descricao' => 'Cancelado',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_status' => 3,
                'sigla' => 'EA',
                'descricao' => 'Em aberto',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_status' => 4,
                'sigla' => 'EC',
                'descricao' => 'Encerrado',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('status', function (Blueprint $table) {
            Schema::dropIfExists('status');
        });
    }
};