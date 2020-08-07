<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Voluntario extends Model
{
    protected $fillable = [
        'nome', 'cpf', 'email',
        'dataNascimento'
    ];

    public function projetos()
    {
        return $this->belongsToMany(Projeto::class)->withTimestamps();
    }
}
