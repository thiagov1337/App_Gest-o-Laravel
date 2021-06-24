<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MotivoContato;

class PrincipalController extends Controller
{
    public function principal(){
        $motCont = MotivoContato::all();
        return view('site.principal', ['motivo' => $motCont]);
    }
}
