<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ong extends Model
{
    protected $fillable = [
        'nome', 'cnpj', 'email',
        'dataCriacao', 'descricao', 'senha'
    ];

    protected $hidden = [
        'senha'
    ];

    public function projetos(): HasMany
    {
        return $this->hasMany(Projeto::class);
    }
}
