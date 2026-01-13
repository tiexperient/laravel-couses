<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use OwenIt\Auditing\Contracts\Auditable;

class Lesson extends Model //implements Auditable
{
    //use \OwenIt\Auditing\Auditable;

    // Indicar o nome da tabela
    protected $table = 'lessons';

    // Indicar quais colunas podem ser manipuladas
    protected $fillable = ['name'];

    // Criar relacionamento de um para muitos | Chave estrangeira
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
