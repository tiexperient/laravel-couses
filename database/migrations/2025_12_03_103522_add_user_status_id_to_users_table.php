<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executar as alterações na base de dados
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('user_status_id')         // Nome da chave estrangeira
                ->after('remember_token')               // Após o campo remember token
                ->default(1)
                ->constrained('statuses')               // Quem possui a chave primária
                #->constrained('user_statuses')         // Quem possui a chave primária
                ->onUpdate('cascade')                   // Se editar, edita em todos
                ->onDelete('restrict');                 // Se excluir a status, não exclui o usuário
        });
    }

    /**
     * Reverte as alterações na base de dados
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['user_status_id']);         // Nome da chave primária
            $table->dropColumn('user_status_id');
        });
    }
};
