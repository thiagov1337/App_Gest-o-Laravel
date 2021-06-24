<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// SiteContato -> site_contatos

class SiteContato extends Model
{
    protected $fillable = ['name', 'telefone', 'email', 'motivo_contatos_id', 'mensagem'];
}



