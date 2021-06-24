<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// fornecedors
class Fornecedor extends Model
{
    use softDeletes;
    protected $table = 'fornecedores'; // antes tava fornecedors
    protected $fillable = ['name', 'site', 'uf', 'email'];

    public function produtos()
    {
        return $this->hasMany('App\Produto', 'fornecedor_id', 'id');
    }
}

