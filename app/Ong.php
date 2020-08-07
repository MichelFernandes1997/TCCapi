<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ong extends Model
{
    protected $fillable = [
        'nome', 'cnpj', 'email',
        'dataCriacao', 'descricao'
    ];

    public function projetos()
    {
        return $this->hasMany(Projeto::class);
    }
}
