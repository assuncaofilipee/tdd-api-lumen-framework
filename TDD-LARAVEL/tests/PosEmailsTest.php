<?php

use App\Jobs\SendEmail;
use App\Mail\PosAlteracaoDeSituacao;
use App\Models\Cliente;
use App\Models\Pos;
use App\Models\PosSituacao;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Laravel\Lumen\Testing\DatabaseMigrations;

class PosEmailsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_sends_pos_updated_situation_email()
    {
        Mail::fake();
        Mail::to('somebody@example.org')->send(new PosAlteracaoDeSituacao(
        $nameCliente = 'Joaozinho',$namePos ='GERTEC', $posSituacao = 'Ativo'));
        Mail::assertSent(PosAlteracaoDeSituacao::class, function ($mail) use ($nameCliente,$namePos,$posSituacao) {
            $mail->build();
            $this->assertTrue($mail->hasTo('somebody@example.org'));
            return $mail->nameCliente === $nameCliente &&
                $mail->namePos === $namePos &&
                $mail->posSituacao === $posSituacao;
        });
    }

    /** @test */
    public function if_event_email_is_queue()
    {
        Queue::fake();
        $pos = Pos::factory()->create();
        $pos->cliente()->associate(Cliente::factory()->create())->save();
        $pos->posSituacao()->associate(PosSituacao::factory()->create())->save();
        Queue::assertPushed(SendEmail::class);
    }
}
