<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class LoginController extends Controller
{
    public function index(Request $request){
        $erro = '';
        
        if($request->get('erro') == 1){
            $erro = 'Usuário não cadastrado';
        }else if($request->get('erro') == 2){
            $erro = 'Necessário realizar login para ter acesso a página';
        }
        
        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
    }

    public function autenticar(Request $request){
        $regras = [
            'usuario' => 'email',
            'senha' => 'required'
        ];

        $feedback = [
            'required' => 'O campo nome precisa ser preenchido :('
        ]; //nao sendo usado =d

        $request->validate($regras);
        $email = $request->usuario;
        $password = $request->get('senha');
        
        // iniciar Model User
        $user = new User();

        $usuario = $user->where('email', '=', $email)->where('password', $password)->get()->first();
        // dd($usuario);

        if(isset($usuario->name)) {
           
            session_start();
            $_SESSION['nome'] = $usuario->name; 
            $_SESSION['email'] = $usuario->email; 

            return redirect()->route('app.home');
        }else{
            // return view('site.login', ['error' => 'Usuario não existe', 'titulo' => 'Login']);
            return redirect()->route('site.login', ['erro' => 1]);
        }
    }
 
    public function sair(Request $request){
        session_destroy();
        return redirect()->route('site.index');
    }
}