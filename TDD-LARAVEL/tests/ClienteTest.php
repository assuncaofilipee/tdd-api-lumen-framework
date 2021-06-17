<?php

use App\Models\Cliente;
use App\Models\Pos;
use Laravel\Lumen\Testing\DatabaseMigrations;

class ClienteTest extends TestCase
{
    use DatabaseMigrations;

    protected $clientMaked;
    protected $clientCreated;

    public function setUp(): void
    {
        parent::setUp();
        $this->clientMaked = Cliente::factory()->make()->toArray();
        $this->clientCreated = Cliente::factory()->create()->toArray();
    }

    /** @test */
    public function client_can_be_created()
    {
        $response = $this->http->post('cliente/store',$this->clientMaked);
        $this->assertEquals(201,$response->getStatusCode());
        $this->assertNotEmpty($response->getData()['data']);
    }

    /** @test */
    public function client_cannot_be_created_with_invalid_data()
    {
        $this->clientMaked['dt_situacao'] = '2019-03-20';
        $response = $this->http->post('cliente/store',$this->clientMaked);
        $this->assertEquals(422,$response->getStatusCode());
        $this->assertEquals('O formato do campo dt_situacao está inválido',
        $response->getData()['ds_detalhes']->ds_campos->dt_situacao);
    }

    /** @test */
    public function it_should_return_client()
    {
        $response = $this->http->get("cliente/show/{$this->clientCreated['id_cliente']}");
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertEquals($this->clientCreated, $response->getData()['data']);
    }

    /** @test */
    public function it_should_return_clients()
    {
        $response = $this->http->get('cliente/show');
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertNotEmpty($response->getData()['data']);
    }

    /** @test */
    public function client_can_updated()
    {
        $response = $this->http->put("cliente/update/{$this->clientCreated['id_cliente']}", ['ds_razao_social' => 'alibin']);
        $this->clientCreated['ds_razao_social'] = 'alibin';
        $this->clientCreated['updated_at'] = $response->getData()['data']['updated_at'];
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertEquals($this->clientCreated, $response->getData()['data']);
    }

    /** @test */
    public function client_cannot_updated_with_invalid_data()
    {
        $response = $this->http->put("cliente/update/{$this->clientCreated['id_cliente']}",
        ['nu_telefone' => '123456789123456789123']);
        $this->assertEquals(422,$response->getStatusCode());
        $this->assertEquals("O campo nu_telefone não permite essa quantidade de digitos",
        $response->getData()['ds_detalhes']->ds_campos->nu_telefone);
    }

    /** @test */
    public function client_can_be_deleted()
    {
        $cliente = Cliente::factory()->count(2)->create()->toArray();
        $response = $this->http->delete("cliente/delete/{$cliente[1]['id_cliente']}",[]);
        $this->assertEquals(200,$response->getStatusCode());
        $this->notSeeInDatabase('cliente',['id_cliente'=> $cliente[1]['id_cliente']]);
        $this->seeInDatabase('cliente',['id_cliente'=> $cliente[0]['id_cliente']]);
    }

    /** @test */
    public function client_cannot_be_deleted_without_id()
    {
        $response = $this->http->delete("cliente/delete/404",[]);
        $this->assertEquals(500,$response->getStatusCode());
    }

    /** @test */
    public function client_has_many_pos()
    {
        $cliente = Cliente::factory()->create();
        $pos = Pos::factory()->count(2)->create();
        foreach($pos as $posToAssociate) {
            $cliente->pos()->save($posToAssociate);
        }
        $this->assertEquals(2,$cliente->pos()->count());
    }

}
