<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{

    public function index(){
        // $fornecedores = 
        // ['Fornecedor1' => [
        //         'nome' => 'Fornecedor1',
        //         'status' => 'A',
        //         'CNPJ' => null],
            
        //     'Fornecedor2' => [
        //         'nome' => 'Fornecedor2',
        //         'status' => 'I',
        //         'CNPJ' => null]
        // ];
        // return view('app.fornecedor.index', compact('fornecedores'));
  
        return view('app.fornecedor.index');
        
    }

    public function listar(Request $request)
    {   
        $fornecedores = Fornecedor::with(['produtos'])->where('name', 'like', '%'.$request->input('name').'%')
                                    ->where('email', 'like', '%'.$request->input('email').'%')
                                    ->where('uf', 'like', '%'.$request->input('uf').'%')
                                    ->where('site', 'like', '%'.$request->input('site').'%')
                                    ->paginate(2); //get();

        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all()]);
    }

 
    public function adicionar(Request $request)
    {
        $msg = '';
        //inclusao
        if ($request->input('_token') <> '' && $request->input('id') == '') {
            $regras = [
                'name' => 'required|min:3|max:40|unique:fornecedores',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email'
            ];
        
            $feedback = [
                'name.unique' => 'Nome já existente.',
                'name.min' => 'O campo nome deve ter no mínimo 3 caracteres.',
                'name.min' => 'O campo nome deve ter no mánimo 10 caracteres.',
                'uf.min' => 'O campo UF deve ter no mínimo 2 caracteres.',
                'uf.max' => 'O campo UF deve ter no máximo 2 caracteres.',
                'email.email' => 'O campo Email não foi preenchido corretamente'
            ];
            
            $request->validate($regras, $feedback);

           $fornecedor = Fornecedor::create($request->all());
           $msg = 'Fornecedor: '.$fornecedor->name.' cadastrado com Sucesso!';
        }

        //edição

        if ($request->input('_token') <> '' && $request->input('id') <> '') {
            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());
            
            if ($update) {
                $msg = "Atualização realizada com Sucesso!";
            }else{
                $msg = "Erro ao tentar atualizar o registro";
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);    
            
        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }


    public function editar($id, $msg = '')
    {
        $fornecedor = Fornecedor::find($id);
        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor,  'msg' => $msg]);
    }
   
    public function excluir($id)
    {
        $fornecedor = Fornecedor::find($id)->delete();
        return redirect()->route('app.fornecedor');  
    }
}
