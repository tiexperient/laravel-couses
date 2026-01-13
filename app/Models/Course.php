<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use OwenIt\Auditing\Contracts\Auditable;

class Course extends Model //implements Auditable
{
    //use \OwenIt\Auditing\Auditable;

    // Indicar o nome da tabela
    protected $table = 'courses';

    // Indicar quais colunas podem ser manipuladas
    protected $fillable = ['name'];

    // Criar relacionamento de um para muitos | Chave primária
    public function courseBatch()
    {
        return $this->hasMany(CourseBatch::class);
    }

    // Criar relacionamento de um para muitos | Chave estrangeira
    public function courseStatus()
    {
        return $this->belongsTo(CourseStatus::class, 'course_statuses_id');
    }
}
