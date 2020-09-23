<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class LoginController extends Controller
{
    
   public function login(Request $request){
        $verificaLogin = request(['email','password']);
        if(!Auth::attempt($verificaLogin)){
            $retorno = [
                'error' => 'Não autorizado',
            ];
            return response()->json($retorno);
        }
        $usuario = $request->user();

        $retorno['name'] = $usuario->name;
        $retorno['email'] = $usuario->email;
        $retorno['token'] = $usuario->createToken('token')->accessToken;

        return response()->json($retorno);
   }

   public function logout(Request $request){
    
        $request->user()->token->revoke();
        $retorno = [
            'message' => 'Logout efetuado com sucesso.'
        ];
        return response()->json($retorno);

   }
}
