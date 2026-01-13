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
        Schema::table('modules', function (Blueprint $table) {
            $table->foreignId('course_batch_id')        // Nome da chave estrangeira
                ->after('name')                         // Após o campo nome
                ->constrained('course_batches')         // Quem possui a chave primária
                ->onUpdate('cascade')                   // Se editar, edita em todos
                ->onDelete('cascade');                  // Se excluir a turma, exclui o módulo
        });
    }

    /**
     * Reverte as alterações na base de dados
     */
    public function down(): void
    {
        Schema::table('modules', function (Blueprint $table) {
            $table->dropForeign(['course_batch_id']);         // Nome da chave primária
            $table->dropColumn('course_batch_id');
        });
    }
};
