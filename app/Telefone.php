<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = ['telefone'];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}
