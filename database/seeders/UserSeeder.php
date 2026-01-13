<?php

namespace Database\Seeders;

use App\Models\User;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Capturar possíveis exceções durante a execução do seeder
        try {
            // Verificar se o usuário está cadastrado no banco de dados
            if(!User::where('email', 'celia.megatronn@gmail.com')->first()){
                // Cadastrar o usuário
                $superAdmin = user:: create([
                    'name' => 'Cesar',
                    'email' => 'celia.megatronn@gmail.com',
                    'password' => '123456#'
                ]);

                // Atribuir papel para o usuário
                $superAdmin->assignRole('Super Admin');

                //******************************************************************** */
            }

            // Cadastrar esses usuários somente em ambiente de produção
            if(App::environment() !== 'production'){
                    // Se não encontrar o registro com o e-mail, cadastra o registro no BD
                    $admin = User::firstOrCreate(
                        ['email' => 'tiexperient@gmail.com'],
                        ['name' => 'TIExperient', 'email' => 'tiexperient@gmail.com',
                        'password' => '123456#'],
                );

                    // Atribuir papel para o usuário
                    $admin->assignRole('Admin');

                    //******************************************************************** */

                    // Se não encontrar o registro com o e-mail, cadastra o registro no BD
                    $teacher = User::firstOrCreate(
                        ['email' => 'amogurumidf@gmail.com'],
                        ['name' => 'Célia Medeiros', 'email' => 'amogurumidf@gmail.com',
                        'password' => '123456#'],
                );

                    // Atribuir papel para o usuário
                    $teacher->assignRole('Professor');
                    $teacher->assignRole('Aluno');

                    //******************************************************************** */

                    // Se não encontrar o registro com o e-mail, cadastra o registro no BD
                    $tutor = User::firstOrCreate(
                        ['email' => 'meuxodozinpets@gmail.com'],
                        ['name' => 'Meu Xodozin Pets', 'email' => 'meuxodozinpets@gmail.com',
                        'password' => '123456#'],
                );

                    // Atribuir papel para o usuário
                    $tutor->assignRole('Tutor');

                    //******************************************************************** */

                    // Se não encontrar o registro com o e-mail, cadastra o registro no BD
                    $student = User::firstOrCreate(
                        ['email' => 'criacaormartdesign@hotmail.com'],
                        ['name' => 'RM Art Design', 'email' => 'criacaormartdesign@hotmail.com',
                        'password' => '123456#'],
                );

                    // Atribuir papel para o usuário
                    $student->assignRole('Aluno');
            }

        } catch (Exception $e) {
            // Salvar log
            Log::notice('Usuário não cadastrado.', ['error' => $e->getMessage()]);
        }

    }
}
