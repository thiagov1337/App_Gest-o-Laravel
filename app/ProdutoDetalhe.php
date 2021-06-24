<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutoDetalhe extends Model
{
    protected $table = 'produto_detalhe';
    protected $fillable = ['produto_id', 'comprimento', 'largura', 'altura', 'unidade_id'];

    public function produto(){
        return $this->belongsTo('App\Produto');
    }
}
