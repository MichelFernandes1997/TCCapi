<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ong;

use App\Voluntario;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $isVoluntario = Voluntario::where('email', $request->username)
                                    ->get();

        if ($isVoluntario->first()) {
            if ($isVoluntario->first()->senha === $request->password) {
                return response()->json(["user" => $isVoluntario->first()], 200);
            } else {
                return response()->json(["error" => "A senha está incorreta"], 400);
            }
        } else {
            $isOng = Ong::where('email', $request->username)
                          ->get();
                          
            if ($isOng->first()) {
                if ($isOng->first()->senha === $request->password) {
                    return response()->json(["user" => $isOng->first()], 200);
                } else {
                    return response()->json(["error" => "A senha está incorreta"], 400);
                }
            }else {
                return response()->json(["error" => "Usuário não encontrado"], 400);
            }
        }
    }

    public function logout()
    {
        
    }

    public function me() {}
}
