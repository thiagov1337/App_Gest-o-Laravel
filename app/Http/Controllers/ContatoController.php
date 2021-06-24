<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MotivoContato;
use App\SiteContato;
class ContatoController extends Controller
{
    public function contato(Request $request){
        // dd($request);
        // $contato = new SiteContato();
        // $contato->name = $request->name;
        // $contato->telefone = $request->tel;
        // $contato->email = $request->email;
        // $contato->motivo = $request->motCont;
        // $contato->mensagem = $request->mensagem;
        
        // dd($contato->getAttributes());
        
        // $contato->fill($request->all());
        // $contato->create($request->all());
        
        //  $contato->save();
      
        $motCont = MotivoContato::all();
        return view('site.contato', ['titulo' => 'Contato' , 'motivo' => $motCont]);
        
    }


    public function salvar(Request $request){
        //validação
        $request->validate([
            'name' => 'required|min:3|max:40|unique:site_contatos',
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000',
        ],
        [
            //'name.required' => 'O campo nome precisa ser preenchido :(',
            //'required' => 'O campo :attribute precisa ser preenchido :(',
            'required' => 'O campo nome precisa ser preenchido :(',
            'name.min' => 'O campo nome precisa ter mínimo 3 caracteres :(',
            'name.max' => 'O campo nome precisa ter maximo 40 caracteres :(',
            'name.unique' => 'Já registrado :(',
        ]);

        SiteContato::create($request->all()); //names dos inputs = bd column
        return redirect()->route('site.index');
        // dd($request);
     
    }

}

