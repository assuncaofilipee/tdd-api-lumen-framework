<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PosAlteracaoDeSituacao extends Mailable
{
    use Queueable, SerializesModels;

    public $nameCliente;
    public $namePos;
    public $posSituacao;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nameCliente,$namePos,$posSituacao)
    {
        $this->nameCliente = $nameCliente;
        $this->namePos = $namePos;
        $this->posSituacao =  $posSituacao;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.PosAlteracaoDeSituacao');
    }
}
