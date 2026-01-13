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
        Schema::table('lessons', function (Blueprint $table) {
            $table->foreignId('module_id')              // Nome da chave estrangeira
                ->after('name')                         // Após o campo nome
                ->constrained('modules')                // Quem possui a chave primária
                ->onUpdate('cascade')                   // Se editar, edita em todos
                ->onDelete('cascade');                  // Se excluir a turma, exclui o módulo
        });
    }

    /**
     * Reverte as alterações na base de dados
     */
    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropForeign(['module_id']);         // Nome da chave primária
            $table->dropColumn('module_id');
        });
    }
};
