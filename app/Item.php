<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'produtos'; // tabela
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id'];

    public function produtoDetalhe(){
                            //model                 fk          pk
        return $this->hasOne('App\ItemDetalhe', 'produto_id', 'id');
    }
}

