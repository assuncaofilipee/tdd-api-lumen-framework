<?php

namespace App\Http\Controllers\Versions\v0100;

use Alibin\Laravel\Facades\Response;
use Alibin\Laravel\Facades\Stage;
use App\Models\Distribuidor;
use Illuminate\Http\Request;

class DistribuidorController extends Controller
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
     * Cadastra um novo distribuidor
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Alibin\Laravel\Facades\Response
     */
    public function store(Request $request)
    {
        $stage = Stage::of('distribuidor')->setData($request->all());
        if(!$stage->isValid()) {
            return Response::error(
                $stage->trans('invalid_fields', 'nu_codigo'),
                $stage->trans('invalid_fields', 'ds_mensagem'),
                ['ds_campos' => $stage->getErrors()], 422);
        }
        $data = Distribuidor::create($request->all());
        return Response::success(['data' => $data],null,201);
    }

    /**
     * Exibe um Distribuidor
     *
     * @param  $id
     * @return \Alibin\Laravel\Facades\Response
     */
    public function show($id = null)
    {
        if(empty($id)) {
            $paginate =  Distribuidor::paginate(15)->toArray();
            $data = $paginate['data'];
            unset($paginate['data']);
            return Response::success(['data' => $data],$paginate,200);
        }

        $data = Distribuidor::find($id);
        return Response::success(['data' => $data],null,200);
    }

    /**
     * Atualiza um Distribuidor
     * @param  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Alibin\Laravel\Facades\Response
     */
    public function update(Request $request, $id)
    {
        $data = Distribuidor::findOrFail($id);

        $stage = Stage::of('distribuidor')->setData($request->all());
        if(!$stage->isValid()) {
            return Response::error(
                $stage->trans('invalid_fields', 'nu_codigo'),
                $stage->trans('invalid_fields', 'ds_mensagem'),
                ['ds_campos' => $stage->getErrors()], 422);
        }
        $data->update($stage->get(null,true));
        return Response::success(['data' => $data],null,200);
    }

    /**
     * Deleta um Distribuidor
     *
     * @param  $id
     * @return \Alibin\Laravel\Facades\Response
     */
    public function delete($id)
    {
        $data = Distribuidor::findOrFail($id)->delete();
        return Response::success(['data' => $data],null,200);
    }
}
