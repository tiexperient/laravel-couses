<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use OwenIt\Auditing\Contracts\Auditable;

class Module extends Model //implements Auditable
{
    //use \OwenIt\Auditing\Auditable;

    // Indicar o nome da tabela
    protected $table = 'modules';

    // Indicar quais colunas podem ser manipuladas
    protected $fillable = ['name', 'course_batch_id'];

    // Criar relacionamento de um para muitos | Chave estrangeira
    public function courseBatch()
    {
        return $this->belongsTo(courseBatch::class);
    }

    // Criar relacionamento de um para muitos | Chave primária
    public function lesson()
    {
        return $this->hasMany(Lesson::class);
    }
}
