<?php

namespace Database\Seeders;

use App\Models\Status;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            // Capturar possíveis exceções durante a execução do seeder
            try {
                // Se não encontrar o registro com o nome e o id, cadastra o registro no BD
                Status::firstOrCreate(
                    ['name' => 'Ativo', 'id' => 1],
                    ['id' => 1, 'name' => 'Ativo']
                );

                // Se não encontrar o registro com o nome, cadastra o registro no BD
                Status::firstOrCreate(
                    ['name' => 'Inativo', 'id' => 2],
                    ['id' => 2, 'name' => 'Inativo']
                );

                // Se não encontrar o registro com o nome, cadastra o registro no BD
                Status::firstOrCreate(
                    ['name' => 'Aguardando Confirmação', 'id' => 3],
                    ['id' => 3, 'name' => 'Aguardando Confirmação']
                );

                // Se não encontrar o registro com o nome, cadastra o registro no BD
                Status::firstOrCreate(
                    ['name' => 'Spam', 'id' => 3],
                    ['id' => 4, 'name' => 'Spam']
                );

        } catch (Exception $e) {
            // Salvar log
            Log::notice('Status não cadastrado.', ['error' => $e->getMessage()]);
        }
    }
}
