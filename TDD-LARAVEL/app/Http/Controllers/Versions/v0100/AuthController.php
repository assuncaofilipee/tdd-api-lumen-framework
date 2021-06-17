<?php

namespace App\Http\Controllers\Versions\v0100;

use Alibin\Laravel\Facades\Response;
use Alibin\Laravel\Facades\Stage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Class constructor.
     *
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Cadastra um novo usuário
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Alibin\Laravel\Facades\Response
     */
    public function register(Request $request)
    {
        $stage = Stage::of('auth.store')->setData($request->all());

        if(!$stage->isValid()) {
            return Response::error(
                $stage->trans('invalid_fields', 'nu_codigo'),
                $stage->trans('invalid_fields', 'ds_mensagem'),
                ['ds_campos' => $stage->getErrors()], 422);
        }
        $data = $stage->get();
        $data['password'] = app('hash')->make($data['password']);
        $user = User::create($data);
        $token = JWTAuth::fromUser($user);
        return Response::success(['token' => $token],null,201);
    }

    /**
     * Autentica um usuário
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Alibin\Laravel\Facades\Response
     */
    public function login(Request $request)
    {
        $stage = Stage::of('auth.login')->setData($request->all());
        if(!$stage->isValid()) {
            return Response::error(
                $stage->trans('invalid_fields', 'nu_codigo'),
                $stage->trans('invalid_fields', 'ds_mensagem'),
                ['ds_campos' => $stage->getErrors()], 422);
        }
        $credentials = $request->only(['email','password']);
        if (! $token = auth()->attempt($credentials))
            return Response::error(
                $stage->trans('invalid', 'nu_codigo'),
                $stage->trans('invalid', 'ds_mensagem'),
                [], 401
            );
        return Response::success(['token' => $token],null,200);
    }

    /**
     * Desconecta um usuário
     *
     * @return \Alibin\Laravel\Facades\Response
     */
    public function logout () {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
