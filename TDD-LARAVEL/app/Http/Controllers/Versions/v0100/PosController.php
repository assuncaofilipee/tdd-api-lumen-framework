<?php

namespace App\Http\Controllers\Versions\v0100;

use Alibin\Laravel\Facades\Stage;
use App\Models\PosSituacao;
use App\Models\Pos;
use Illuminate\Http\Request;
use Alibin\Laravel\Facades\Response;
use Illuminate\Support\Facades\Gate;

class PosController extends Controller
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
     * Cadastra um novo POS
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Alibin\Laravel\Facades\Response
     */
    public function store(Request $request)
    {
        $stage = Stage::of('pos.store')->setData($request->all());

        if(!$stage->isValid()) {
            return Response::error(
                $stage->trans('invalid_fields', 'nu_codigo'),
                $stage->trans('invalid_fields', 'ds_mensagem'),
                ['ds_campos' => $stage->getErrors()], 422);
        }

        $data = Pos::create($stage->get(null,true));
        return Response::success(['data' => $data],null,201);
    }

    /**
     * Exibe um POS
     *
     * @param  $id
     * @return \Alibin\Laravel\Facades\Response
     */
    public function show($id = null)
    {
        if(empty($id)) {
            $paginate =  Pos::paginate(15)->toArray();
            $data = $paginate['data'];
            unset($paginate['data']);
            return Response::success(['data' => $data],$paginate,200);
        }

        $data = Pos::findOrFail($id);
        return Response::success(['data' => $data],null,200);
    }

    /**
     * Atualiza um POS
     *
     * @param  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Alibin\Laravel\Facades\Response
     */
    public function update(Request $request, $id)
    {
        $pos = Pos::findOrFail($id);

        if (Gate::denies('update-pos', $pos)) {
            return Response::error(trans('pos-response.unauthorized.nu_codigo'),
                trans('user-response.unauthorized.message'), [],403, '');
        }

        $stage = Stage::of('pos.update')->setData($request->all());
        if(!$stage->isValid()) {
            return Response::error(
                $stage->trans('invalid_fields', 'nu_codigo'),
                $stage->trans('invalid_fields', 'ds_mensagem'),
                ['ds_campos' => $stage->getErrors()], 422,'');
        }

        if(!empty($stage->get('id_cliente') || $stage->get('id_distribuidor'))) {
            if($pos->posSituacao()->first()->nm_pos_situacao != PosSituacao::find(2)->nm_pos_situacao) {
                return Response::error(trans('pos-response.posNotAvailable.nu_codigo'),
                trans('pos-response.posNotAvailable.message'), [],422, '');
            }
        }

        $pos->fill($stage->get(null,true));
        return Response::success(['data' => $pos],null,200);
    }

    /**
     * Deleta um POS
     *
     * @param  $id
     * @return \Alibin\Laravel\Facades\Response
     */
    public function delete($id)
    {
        $pos = Pos::findOrFail($id);

        if (Gate::denies('update-pos', $pos)) {
            return Response::error(trans('pos-response.unauthorized.nu_codigo'),
                trans('user-response.unauthorized.message'), [], 403, '');
        }

        $pos->delete();
        return Response::success(['data' => $pos],null,200);
    }

    /**
     * Altera a situaçao do POS pelo id do cliente
     *
     * @param $id_cliente
     * @param $id_pos_situacao
     * @return \Alibin\Laravel\Facades\Response
     */
    public function alterarSituacaoPosPorCliente($id_cliente,$id_pos_situacao)
    {
        $pos = Pos::where('id_cliente',  $id_cliente)->firstOrFail();

        if (Gate::denies('update-pos', $pos)) {
            return Response::error(trans('pos-response.unauthorized.nu_codigo'),
                trans('user-response.unauthorized.message'), [],403, '');
        }

        $posSituation = PosSituacao::findOrFail($id_pos_situacao);
        $pos->posSituacao()->associate($posSituation)->save();
        return Response::success(['data' => $pos],null,200);
    }
}
