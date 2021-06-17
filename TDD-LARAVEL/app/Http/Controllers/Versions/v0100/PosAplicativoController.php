<?php

namespace App\Http\Controllers\Versions\v0100;

use Alibin\Laravel\Facades\Response;
use Alibin\Laravel\Facades\Stage;
use App\Models\PosAplicativo;
use Illuminate\Http\Request;
class PosAplicativoController extends Controller
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
     * Cadastra um novo aplicativo pos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Alibin\Laravel\Facades\Response
     */
    public function store(Request $request)
    {
        $stage = Stage::of('aplicativo.store')->setData($request->all());
        if(!$stage->isValid()) {
            return Response::error(
                $stage->trans('invalid_fields', 'nu_codigo'),
                $stage->trans('invalid_fields', 'ds_mensagem'),
                ['ds_campos' => $stage->getErrors()], 422);
        }

        $data = PosAplicativo::create($stage->get());
        return Response::success(['data' => $data],null,201);
    }

    /**
     * Exibe um aplicativo POS
     *
     * @param  $id
     * @return \Alibin\Laravel\Facades\Response
     */
    public function show($id = null)
    {
        if(empty($id)) {
            $paginate =  PosAplicativo::paginate(15)->toArray();
            $data = $paginate['data'];
            unset($paginate['data']);
            return Response::success(['data' => $data],$paginate,200);
        }

        $data = PosAplicativo::find($id);
        return Response::success(['data' => $data],null,200);
    }

    /**
     * Atualiza um aplicativo POS
     *
     * @param  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Alibin\Laravel\Facades\Response
     */
    public function update(Request $request, $id)
    {
        $data = PosAplicativo::findOrFail($id);
        $stage = Stage::of('aplicativo.update')->setData($request->all());
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
     * Deleta um aplicativo POS
     *
     * @param  $id
     * @return \Alibin\Laravel\Facades\Response
     */
    public function delete($id)
    {
        $data = PosAplicativo::findOrFail($id)->delete();
        return Response::success(['data' => $data],null,200);
    }
}
