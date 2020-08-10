<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Voluntario extends Model
{
    protected $fillable = [
        'nome', 'cpf', 'email',
        'dataNascimento', 'senha'
    ];

    protected $hidden = [
        'senha'
    ];

    public function projetos(): BelongsToMany
    {
        return $this->belongsToMany(Projeto::class)->withTimestamps();
    }
}
