<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateDataBase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-data-base {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criando um novo banco de dados';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $nomeBancoDados = $this->argument('name');

        try {

            // Criando banco de dados
            $defaultConnection = config('database.default'); 

            config(["database.connections.$defaultConnection.database" => null]);

            // Criar o banco de dados
            DB::statement("CREATE DATABASE `$nomeBancoDados` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            $this->info("Banco de dados '$nomeBancoDados' criado com sucesso.");

        } catch (\Exception $e) {

            $this->error('Erro ao criar o banco de dados: ' . $e->getMessage());
        }

        return 0;
    }
}
