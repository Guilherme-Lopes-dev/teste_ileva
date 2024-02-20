<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = ['pessoa_id','email'];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}
