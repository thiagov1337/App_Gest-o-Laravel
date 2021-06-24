<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['cliente_id'];
    /**
    * Get the user associated with the Pedido
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function produtos()
    {
        return $this->belongsToMany('App\Produto', 'pedido_produtos', 'pedido_id', 'produto_id')->withPivot('created_at','quantidade', 'id');
    }
}


