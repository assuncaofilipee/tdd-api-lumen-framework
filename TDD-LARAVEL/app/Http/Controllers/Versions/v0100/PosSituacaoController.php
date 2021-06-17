<?php

namespace App\Http\Controllers\Versions\v0100;

use Alibin\Laravel\Facades\Response;
use Alibin\Laravel\Facades\Stage;
use App\Models\PosSituacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PosSituacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request)
    {
        $stage = Stage::of('situacao.store')->setData($request->all());
        if(!$stage->isValid())
            return Response::error(
                $stage->trans('invalid_fields', 'nu_codigo'),
                $stage->trans('invalid_fields', 'ds_mensagem'),
                ['ds_campos' => $stage->getErrors()],422
            );
        $data = PosSituacao::create($stage->get(null,true));
        return Response::success(['data' => $data],null,201);
    }

    public function show($id = null)
    {
        if(empty($id)) {
            $paginate =  PosSituacao::paginate(15)->toArray();
            $data = $paginate['data'];
            unset($paginate['data']);
            return Response::success(['data' => $data],$paginate,200);
        }

        $data = PosSituacao::find($id);
        return Response::success(['data' => $data],null,200);
    }

    public function update(Request $request, $id)
    {
        $data = PosSituacao::findOrFail($id);
        $stage = Stage::of('situacao.update')->setData($request->all());
        if(!$stage->isValid()) {
            return Response::error(
                $stage->trans('invalid_fields', 'nu_codigo'),
                $stage->trans('invalid_fields', 'ds_mensagem'),
                ['ds_campos' => $stage->getErrors()], 422);
        }
        $data->update($request->all());
        return Response::success(['data' => $data],null,200);
    }

    public function delete($id)
    {
        $data = PosSituacao::findOrFail($id)->delete();
        return Response::success(['data' => $data],null,200);
    }
}
