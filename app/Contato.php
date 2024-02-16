<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = ['email', 'telefone', 'whatsapp'];

    // Adicionando a inversa do relacionamento belongsTo
    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}