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
        Schema::table('course_batches', function (Blueprint $table) {
            $table->foreignId('course_id')      // Nome da chave estrangeira
                ->after('name')                 // Após o campo nome
                ->constrained('courses')        // Quem possui a chave primária
                ->onUpdate('cascade')           // Se editar, edita em todos
                ->onDelete('cascade');          // Se excluir um curso, exclui a turma
        });
    }

    /**
     * Reverte as alterações na base de dados
     */
    public function down(): void
    {
        Schema::table('course_batches', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->dropColumn('course_id');
        });
    }
};
