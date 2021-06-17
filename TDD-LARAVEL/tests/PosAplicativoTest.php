<?php

use App\Models\Pos;
use App\Models\PosAplicativo;
use Laravel\Lumen\Testing\DatabaseMigrations;

class PosAplicativoTest extends TestCase
{
    use DatabaseMigrations;

    protected $posAppMaked;
    protected $posAppCreated;

    public function setUp(): void
    {
        parent::setUp();
        $this->posAppMaked = PosAplicativo::factory()->make()->toArray();
        $this->posAppCreated = PosAplicativo::factory()->create()->toArray();
    }

    /** @test */
    public function app_can_be_created()
    {
        $response = $this->http->post('aplicativo/store',$this->posAppMaked);
        $this->assertEquals(201,$response->getStatusCode());
        $this->assertNotEmpty($response->getData()['data']);
    }

    /** @test */
    public function app_cannot_be_created_with_invalid_data()
    {
        $this->posAppMaked['tp_principal'] = 'teste';
        $response = $this->http->post('aplicativo/store',$this->posAppMaked);
        $this->assertEquals(422,$response->getStatusCode());
        $this->assertEquals('O campo tp_principal deve do tipo verdadeiro ou falso',
        $response->getData()['ds_detalhes']->ds_campos->tp_principal);
    }

    /** @test */
    public function it_should_return_app()
    {
        $response = $this->http->get("aplicativo/show/{$this->posAppCreated['id_pos_aplicativo']}");
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertEquals($this->posAppCreated, $response->getData()['data']);
    }

    /** @test */
    public function it_should_return_apps()
    {
        $response = $this->http->get('aplicativo/show');
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertNotEmpty($response->getData()['data']);
    }

    /** @test */
    public function app_can_updated()
    {
        $response = $this->http->put("aplicativo/update/{$this->posAppCreated['id_pos_aplicativo']}", ['nm_pos_aplicativo' => 'alibin']);
        $this->posAppCreated['nm_pos_aplicativo'] = 'alibin';
        $this->posAppCreated['updated_at'] = $response->getData()['data']['updated_at'];
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertEquals($this->posAppCreated, $response->getData()['data']);
    }

    /** @test */
    public function app_cannot_updated_with_invalid_data()
    {
        $response = $this->http->put("aplicativo/update/{$this->posAppCreated['id_pos_aplicativo']}",
        ['tp_principal' => '6464']);
        $this->assertEquals(422,$response->getStatusCode());
        $this->assertEquals("O campo tp_principal deve do tipo verdadeiro ou falso",
        $response->getData()['ds_detalhes']->ds_campos->tp_principal);
    }

    /** @test */
    public function app_can_be_deleted()
    {
        $posApp = PosAplicativo::factory()->count(2)->create()->toArray();
        $response = $this->http->delete("aplicativo/delete/{$posApp[1]['id_pos_aplicativo']}",[]);
        $this->assertEquals(200,$response->getStatusCode());
        $this->notSeeInDatabase('pos_aplicativo',['id_pos_aplicativo'=> $posApp[1]['id_pos_aplicativo']]);
        $this->seeInDatabase('pos_aplicativo',['id_pos_aplicativo'=> $posApp[0]['id_pos_aplicativo']]);
    }

    /** @test */
    public function app_cannot_be_deleted_without_id()
    {
        $response = $this->http->delete("aplicativo/delete/null",[]);
        $this->assertEquals(500,$response->getStatusCode());
    }

    /** @test */
    public function app_has_many_pos()
    {
        $app = PosAplicativo::factory()->create();
        $pos = Pos::factory()->count(2)->create();
        foreach($pos as $posToAssociate) {
            $app->pos()->save($posToAssociate);
        }
        $this->assertEquals(2,$app->pos()->count());
    }

    protected function tearDown() : void
    {
        unset($this->posAppMaked);
        unset($this->posAppCreated);
    }
}
