<?php

namespace App\Observer;

use App\Jobs\SendEmail;
use App\Models\Cliente;
use App\Models\Pos;
use App\Models\PosSituacao;
use Illuminate\Support\Facades\Log;

class PosObserver
{
    /**
     * POS criada, estado inicial Ativo
     *
     * @param  \App\Models\Pos  $pos
     * @return void
     */
    public function creating(Pos $pos)
    {
        $pos->id_pos_situacao = PosSituacao::firstOrCreate([
            'nm_pos_situacao' => 'Ativo'
        ])->id_pos_situacao;
    }

    /**
     * Estado POS atualizado, dispara email para cliente
     *
     * @param  \App\Models\Pos  $pos
     * @return void
     */
    public function updating(Pos $pos)
    {
        if(isset($pos->id_cliente)) {
            Cliente::findOrFail($pos->id_cliente);
             dispatch(new SendEmail($pos));
        }
    }
}
