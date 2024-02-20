<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Whatsapp extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = ['whatsapp'];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}
