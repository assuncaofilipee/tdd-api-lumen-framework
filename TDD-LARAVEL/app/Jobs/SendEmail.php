<?php

namespace App\Jobs;

use App\Mail\PosAlteracaoDeSituacao;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Job implements ShouldQueue
{
    protected $email;
    protected $nameCliente;
    protected $namePos;
    protected $posSituacao;

    public function __construct($pos)
    {
        $this->email = $pos->cliente()->first()->email;
        $this->nameCliente = $pos->cliente()->first()->nm_cliente;
        $this->namePos = $pos->nm_pos;
        $this->posSituacao = $pos->posSituacao()->first()->nm_pos_situacao;
    }


    public function handle()
    {
        Mail::to($this->email)->send(new PosAlteracaoDeSituacao($this->nameCliente,$this->namePos,$this->posSituacao));
    }
}
