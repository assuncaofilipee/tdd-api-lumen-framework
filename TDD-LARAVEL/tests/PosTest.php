<?php

use App\Models\Cliente;
use App\Models\Distribuidor;
use App\Models\Pos;
use App\Models\PosAplicativo;
use App\Models\PosSituacao;
use Illuminate\Support\Facades\Event;
use Laravel\Lumen\Testing\DatabaseMigrations;

class PosTest extends TestCase
{
    use DatabaseMigrations;
    protected $pos;
    protected $posMaked;
    protected $posCreated;
    protected $posSituation;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed',['--class' => 'PosSituacaoSeeder']);
        Event::fake();
        $this->pos = Pos::factory()->create();
        $distribuidor = Distribuidor::factory()->create();
        $this->user->distribuidor()->associate($distribuidor)->save();
        $this->pos->distribuidor()->associate($distribuidor)->save();
        $this->posMaked = Pos::factory()->make()->toArray();
        $this->posCreated = Pos::factory()->create()->toArray();
        $this->posSituation = PosSituacao::all();
    }

    /** @test */
    public function it_can_be_associate_all()
    {
        $this->withoutEvents();
        $cliente = Cliente::factory()->count(5)->create();
        $distribuidor = Distribuidor::factory()->count(5)->create();
        $posApp = PosAplicativo::factory()->count(5)->create();
        $posSituacao = PosSituacao::factory()->count(5)->create();

        $pos = Pos::factory()->count(5)->create();
        $posAssociate = $pos->get(3);
        $posAssociate->cliente()->associate($cliente->get(1))->save();

        $posAssociate->distribuidor()->associate($distribuidor->get(2))->save();
        $posAssociate->posAplicativo()->associate($posApp->get(3))->save();
        $posAssociate->posSituacao()->associate($posSituacao->get(4))->save();
        $posAssociate = $posAssociate->refresh();

        $this->assertEquals($cliente->get(1)->id_cliente,$posAssociate->id_cliente);
        $this->assertEquals($distribuidor->get(2)->id_distribuidor,$posAssociate->id_distribuidor);
        $this->assertEquals($posApp->get(3)->id_pos_aplicativo,$posAssociate->id_pos_aplicativo);
        $this->assertEquals($posSituacao->get(4)->id_pos_situacao,$posAssociate->id_pos_situacao);

        $pos = $pos->get(1);
        $this->assertNotEquals($cliente->get(1)->id_cliente,$pos->id_cliente);
        $this->assertNotEquals($distribuidor->get(2)->id_distribuidor,$pos->id_cliente);
        $this->assertNotEquals($posApp->get(3)->id_pos_aplicativo,$pos->id_cliente);
        $this->assertNotEquals($posSituacao->get(4)->id_pos_situacao,$pos->id_cliente);
    }

   /** @test */
   public function pos_can_be_created()
   {
       $response = $this->http->post('pos/store',$this->posMaked);
       $this->assertEquals(201,$response->getStatusCode());
       $this->assertNotEmpty($response->getData()['data']);
   }

    /** @test */
    public function pos_start_with_active_status()
    {
        $pos = $this->http->post('pos/store',$this->posMaked);
        $this->assertEquals(PosSituacao::first()->id_pos_situacao,$pos->getData()['data']['id_pos_situacao']);
        $this->seeInDatabase('pos', [
        'id_pos_situacao' => PosSituacao::first()->id_pos_situacao
        ]);
    }

    /** @test */
    public function pos_cannot_be_created_with_invalid_data()
    {
        $this->posMaked['nm_pos_situacao'] = PosSituacao::first()->nm_pos_situacao;
        $this->posMaked['nm_terminal'] = null;
        $response = $this->http->post('pos/store',$this->posMaked);
        $this->assertEquals(422,$response->getStatusCode());
        $this->assertEquals('O campo nm_terminal é obrigatorio',
        $response->getData()['ds_detalhes']->ds_campos->nm_terminal);
    }

    /** @test */
    public function it_should_return_pos()
    {
        $response = $this->http->get("pos/show/{$this->posCreated['id_pos']}");
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertEquals($this->posCreated, $response->getData()['data']);
    }

    /** @test */
    public function it_should_return_all_pos()
    {
        $response = $this->http->get('pos/show');
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertNotEmpty($response->getData()['data']);
    }

    /** @test */
    public function pos_can_updated()
    {
        $response = $this->http->put("pos/update/{$this->pos['id_pos']}", ['nm_pos' => 'alibin']);
        $this->pos = $this->pos->toArray();
        $this->pos['nm_pos'] = 'alibin';
        $this->pos['updated_at'] = $response->getData()['data']['updated_at'];
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertEquals($this->pos, $response->getData()['data']);
    }

    /** @test */
    public function pos_cannot_updated_with_invalid_data()
    {
        $response = $this->http->put("pos/update/{$this->posCreated['id_pos']}", ['nm_terminal' => null]);
        $this->assertEquals(403,$response->getStatusCode());
    }

    /** @test */
    public function pos_can_be_deleted()
    {
        $pos = Pos::factory()->count(2)->create()->get(1);
        $response = $this->http->delete("pos/delete/{$this->pos->id_pos}",[]);
        $this->assertEquals(200,$response->getStatusCode());
        $this->notSeeInDatabase('pos',['id_pos'=> $this->pos->id_pos]);
        $this->seeInDatabase('pos',['id_pos' => $pos->id_pos]);
    }

    /** @test */
    public function pos_cannot_be_deleted_without_id()
    {
        $response = $this->http->delete("pos/delete/null",[]);
        $this->assertEquals(500,$response->getStatusCode());
    }

    /** @test */
    public function pos_can_be_updated_situation()
    {
        $distribuidor = Distribuidor::factory()->create();
        $this->pos->posSituacao()->associate($this->posSituation->first())->save();
        $this->user->distribuidor()->associate($distribuidor)->save();
        $this->pos->distribuidor()->associate($distribuidor)->save();
        $response = $this->http->put("pos/update/{$this->pos->id_pos}", ['id_pos_situacao' => 1]);
        $this->assertEquals(PosSituacao::first()->id_pos_situacao,$response->getData()['data']['id_pos_situacao']);
    }

    /** @test */
    public function pos_can_be_updated_situation_by_client_id()
    {
        $cliente = Cliente::factory()->create();
        $this->pos->cliente()->associate($cliente)->save();
        $this->pos->posSituacao()->associate($this->posSituation->find(2))->save();
        $response = $this->http->put("pos/alterar/situacao/por/cliente/{$cliente->id_cliente}/{$this->posSituation->first()->id_pos_situacao}",[]);
        $this->assertNotEquals(PosSituacao::find(2)->id_pos_situacao,$response->getData()['data']['id_pos_situacao']);
    }

    /** @test */
    public function pos_cannot_updated_situation_by_client_id_without_distributor()
    {
        $this->user->distribuidor()->associate(null)->save();
        $cliente = Cliente::factory()->create();
        $this->pos->cliente()->associate($cliente)->save();
        $response = $this->http->put("pos/alterar/situacao/por/cliente/{$cliente->id_cliente}/1",[]);
        $this->assertEquals(403,$response->getStatusCode());
    }

    /** @test */
    public function pos_can_be_associate_client()
    {
        $cliente = Cliente::factory()->create();
        $this->pos->posSituacao()->associate($this->posSituation->find(2))->save();
        $response = $this->http->put("pos/update/{$this->pos->id_pos}",['id_cliente' => $cliente->id_cliente]);
        $this->assertEquals($cliente->id_cliente,$response->getData()['data']['id_cliente']);
    }

    /** @test */
    public function pos_cannot_be_associate_client_with_invalid_situation()
    {
        $cliente = Cliente::factory()->create();
        $this->pos->posSituacao()->associate($this->posSituation->first())->save();
        $response = $this->http->put("pos/update/{$this->pos->id_pos}",['id_cliente' => $cliente->id_cliente]);
        $this->assertEquals(trans('pos-response.posNotAvailable.message'),$response->getData()['ds_mensagem']);
    }

    /** @test */
    public function pos_can_be_associate_distributor()
    {
        $distribuidor = Distribuidor::factory()->create();
        $this->pos->posSituacao()->associate($this->posSituation->find(2))->save();
        $response = $this->http->put("pos/update/{$this->pos->id_pos}",['id_distribuidor' => $distribuidor->id_distribuidor]);
        $this->assertEquals($distribuidor->id_distribuidor,$response->getData()['data']['id_distribuidor']);
    }

    /** @test */
    public function pos_cannot_be_associate_distributor_with_invalid_situation()
    {
        $distribuidor = Distribuidor::factory()->create();
        $this->pos->posSituacao()->associate($this->posSituation->find(3))->save();
        $response = $this->http->put("pos/update/{$this->pos->id_pos}",['id_distribuidor' => $distribuidor->id_distribuidor]);
        $this->assertEquals(trans('pos-response.posNotAvailable.message'),$response->getData()['ds_mensagem']);
    }

    /** @test */
    public function pos_cannot_be_associate_client_wihout_id()
    {
        $response = $this->http->put("pos/update/{$this->posCreated['id_pos']}",['id_cliente' => null]);
        $this->assertEquals(403,$response->getStatusCode());
    }

    /** @test */
    public function pos_cannot_be_associate_distributor_wihout_id()
    {
        $response = $this->http->put("pos/update/{$this->posCreated['id_pos']}",['id_distribuidor' => null]);
        $this->assertEquals(403,$response->getStatusCode());
    }

    protected function tearDown() : void
    {
        unset($this->pos);
        unset($this->posMaked);
        unset($this->posCreated);
        unset($this->posSituation);
    }
}
