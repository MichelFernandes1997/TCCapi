<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Projeto extends Model
{
    protected $fillable = [
        'nome', 'descricao', 'dataInicio',
        'dataTermino', 'endereco'
    ];

    public function ong()
    {
        return $this->belongsTo(Ong::class);
    }

    public function voluntarios()
    {
        return $this->belongsToMany(Voluntario::class)->withTimestamps();
    }
}
