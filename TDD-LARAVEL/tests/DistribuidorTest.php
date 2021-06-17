<?php

use App\Models\Pos;
use App\Models\Distribuidor;
use Laravel\Lumen\Testing\DatabaseMigrations;

class DistribuidorTest extends TestCase
{
    use DatabaseMigrations;

    protected $distributorMaked;
    protected $distributorCreated;

    public function setUp(): void
    {
        parent::setUp();
        $this->distributorMaked = Distribuidor::factory()->make()->toArray();
        $this->distributorCreated = Distribuidor::factory()->create()->toArray();
    }

    /** @test */
    public function rdistributor_can_be_created()
    {
        $response = $this->http->post('distribuidor/store',$this->distributorMaked);
        $this->assertEquals(201,$response->getStatusCode());
        $this->assertNotEmpty($response->getData()['data']);
    }

    /** @test */
    public function distributor_cannot_be_created_with_invalid_data()
    {
        $this->distributorMaked['nu_documento'] = '123456789123456789123456789123456789';
        $response = $this->http->post('distribuidor/store',$this->distributorMaked);
        $this->assertEquals(422,$response->getStatusCode());
        $this->assertEquals('O campo nu_documento não permite essa quantidade de digitos',
        $response->getData()['ds_detalhes']->ds_campos->nu_documento);
    }

    /** @test */
    public function it_should_return_distributor()
    {
        $response = $this->http->get("distribuidor/show/{$this->distributorCreated['id_distribuidor']}");
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertEquals($this->distributorCreated, $response->getData()['data']);
    }

    /** @test */
    public function it_should_return_distributors()
    {
        $response = $this->http->get('distribuidor/show');
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertNotEmpty($response->getData()['data']);
    }

    /** @test */
    public function distributor_can_updated()
    {
        $response = $this->http->put("distribuidor/update/{$this->distributorCreated['id_distribuidor']}", ['ds_razao_social' => 'alibin']);
        $this->distributorCreated['ds_razao_social'] = 'alibin';
        $this->distributorCreated['updated_at'] = $response->getData()['data']['updated_at'];
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertEquals($this->distributorCreated, $response->getData()['data']);
    }

    /** @test */
    public function distributor_cannot_updated_with_invalid_data()
    {
        $response = $this->http->put("distribuidor/update/{$this->distributorCreated['id_distribuidor']}",
        ['nu_telefone' => '123456789123456789123']);
        $this->assertEquals(422,$response->getStatusCode());
        $this->assertEquals("O campo nu_telefone não permite essa quantidade de digitos",
        $response->getData()['ds_detalhes']->ds_campos->nu_telefone);
    }

    /** @test */
    public function distributor_can_be_deleted()
    {
        $posApp = Distribuidor::factory()->count(2)->create()->toArray();
        $response = $this->http->delete("distribuidor/delete/{$posApp[1]['id_distribuidor']}",[]);
        $this->assertEquals(200,$response->getStatusCode());
        $this->notSeeInDatabase('distribuidor',['id_distribuidor'=> $posApp[1]['id_distribuidor']]);
        $this->seeInDatabase('distribuidor',['id_distribuidor'=> $posApp[0]['id_distribuidor']]);
    }

    /** @test */
    public function distributor_cannot_be_deleted_without_id()
    {
        $response = $this->http->delete("distribuidor/delete/null",[]);
        $this->assertEquals(500,$response->getStatusCode());
    }

    /** @test */
    public function distributor_has_many_pos()
    {
        $distribuidor = Distribuidor::factory()->create();
        $pos = Pos::factory()->count(2)->create();
        foreach($pos as $posToAssociate) {
            $distribuidor->pos()->save($posToAssociate);
        }
        $this->assertEquals(2,$distribuidor->pos()->count());
    }

}
