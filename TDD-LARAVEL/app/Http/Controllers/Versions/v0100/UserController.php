<?php

namespace App\Http\Controllers\Versions\v0100;

use Alibin\Laravel\Facades\Response;
use App\Models\Distribuidor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Class constructor.
     *
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function profile()
    {
        return Response::success(['data' => Auth::user()],null,200);
    }

    /**
     * Get all User.
     *
     * @return Response
     */
    public function allUsers()
    {
        return Response::success(['data' => User::all()],null,200);
    }

    /**
     * Get one user.
     *
     * @return Response
     */
    public function singleUser($id)
    {
        $user = User::find($id);
        return Response::success(['data' => $user],null,200);
    }

    /**
     * Vincula distribuidor a um usuário
     *
     * @param  $id_user
     * @param $id_distribuidor
     * @return \Alibin\Laravel\Facades\Response
     */
    public function vincularDistribuidor($id_usuario,$id_distribuidor)
    {
        $user = User::findOrFail($id_usuario);
        $distribuidor = Distribuidor::findOrFail($id_distribuidor);
        $userAssociateToDistributor = $user->distribuidor()->first();

        if($userAssociateToDistributor && ($userAssociateToDistributor->id_distribuidor != $id_distribuidor)) {
            return Response::error(trans('user-response.userNotAvailable.nu_codigo'),
                trans('user-response.userNotAvailable.message'),[], 422, '');
        }

        $user->distribuidor()->associate($distribuidor)->save();
        return Response::success(['data' => $user],null,200);
    }
}
