<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Projeto extends Model
{
    protected $fillable = [
        'nome', 'descricao', 'dataInicio',
        'dataTermino', 'endereco', 'ong_id'
    ];

    protected $hidden = [
        
    ];

    public function ong(): BelongsTo
    {
        return $this->belongsTo(Ong::class);
    }

    public function voluntarios(): BelongsToMany
    {
        return $this->belongsToMany(Voluntario::class)->withTimestamps();
    }
}
