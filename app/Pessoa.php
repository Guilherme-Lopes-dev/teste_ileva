<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = [
        'nome'
    ];

    // Adicionando o relacionamento hasMany para contatos
    public function contatos()
    {
        return $this->hasMany(Contato::class);
    }
}
