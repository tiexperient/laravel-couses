<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use OwenIt\Auditing\Contracts\Auditable;

class CourseBatch extends Model //implements Auditable
{
    //use \OwenIt\Auditing\Auditable;

    // Indicar o nome da tabela
    protected $table = 'course_batches';

    // Indicar quais colunas podem ser manipuladas
    protected $fillable = [
        'name',
        'course_id', // ⭐ ESTE CAMPO PRECISA ESTAR AQUI
    ];

    // Criar relacionamento de um para muitos | Um curso possue várias turmas
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Criar relacionamento de um para muitos | Um curso possue várias turmas
    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
