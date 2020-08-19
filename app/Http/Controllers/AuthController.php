<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\StorageVoluntarioToken;

use App\Events\StorageOngToken;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Redis;

use Carbon\Carbon;

use App\Ong;

use App\Voluntario;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $isVoluntario = Voluntario::where('email', $request->username)
                                    ->get();

        if ($isVoluntario->first()) {
            $voluntario = $isVoluntario->first();

            if ($voluntario->senha === $request->password) {
                $voluntario->token = Hash::make($voluntario->email.':'.$voluntario->senha.Carbon::now());
                
                event(new StorageVoluntarioToken($voluntario));

                return response()->json(["user" => $voluntario], 200);
            } else {
                return response()->json(["error" => "A senha está incorreta"], 400);
            }
        } else {
            $isOng = Ong::where('email', $request->username)
                          ->get();
                          
            if ($isOng->first()) {
                $ong = $isOng->first();
                if ($ong->senha === $request->password) {
                    $ong->token = Hash::make($ong->email.':'.$ong->senha.Carbon::now());

                    event(new StorageOngToken($ong));

                    return response()->json(["user" => $ong], 200);
                } else {
                    return response()->json(["error" => "A senha está incorreta"], 400);
                }
            }else {
                return response()->json(["error" => "Usuário não encontrado"], 400);
            }
        }
    }

    public function me(Request $request) 
    {
        $me = Redis::get($request->token);

        return response()->json(['user' => json_decode($me)], 200);
    }

    public function logout(Request $request)
    {
        Redis::del($request->token);

        return response()->json(['logout' => true]);
    }
}
