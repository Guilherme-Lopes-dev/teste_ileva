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

    public function emails()
    {
        return $this->hasMany(Email::class, 'pessoa_id');
    }

    public function telefones()
    {
        return $this->hasMany(Telefone::class, 'pessoa_id');
    }

    public function whatsapps()
    {
        return $this->hasMany(Whatsapp::class, 'pessoa_id');
    }
}
