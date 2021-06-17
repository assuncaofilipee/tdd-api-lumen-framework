<?php

use App\Models\Pos;
use App\Models\PosSituacao;
use Laravel\Lumen\Testing\DatabaseMigrations;

class PosSituacaoTest extends TestCase
{
    use DatabaseMigrations;

    protected $posSituationMaked;
    protected $posSituationCreated;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed',['--class' => 'PosSituacaoSeeder']);
        $this->posSituationMaked = PosSituacao::factory()->make()->toArray();
        $this->posSituationCreated = PosSituacao::factory()->create()->toArray();
    }

    /** @test */
    public function situation_can_be_created()
    {
        $response = $this->http->post('situacao/store',$this->posSituationMaked);
        $this->assertEquals(201,$response->getStatusCode());
        $this->assertNotEmpty($response->getData()['data']);
    }

    /** @test */
    public function situation_cannot_be_created_with_invalid_data()
    {
        $this->posSituationMaked['nm_pos_situacao'] = null;
        $response = $this->http->post('situacao/store',$this->posSituationMaked);
        $this->assertEquals(422,$response->getStatusCode());
        $this->assertEquals('O campo nm_pos_situacao é obrigatorio',
        $response->getData()['ds_detalhes']->ds_campos->nm_pos_situacao);
    }

    /** @test */
    public function it_should_return_situation()
    {
        $response = $this->http->get("situacao/show/{$this->posSituationCreated['id_pos_situacao']}");
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertEquals($this->posSituationCreated, $response->getData()['data']);
    }

    /** @test */
    public function it_should_return_situations()
    {
        $response = $this->http->get('situacao/show');
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertNotEmpty($response->getData()['data']);
    }

    /** @test */
    public function situation_can_updated()
    {
        PosSituacao::factory()->create(['nm_pos_situacao' => 'Nova']);
        $response = $this->http->put("situacao/update/{$this->posSituationCreated['id_pos_situacao']}", ['nm_pos_situacao' =>
        PosSituacao::find(4)->nm_pos_situacao]);
        $this->posSituationCreated['nm_pos_situacao'] = PosSituacao::find(4)->nm_pos_situacao;
        $this->posSituationCreated['updated_at'] = $response->getData()['data']['updated_at'];
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertEquals($this->posSituationCreated, $response->getData()['data']);
    }

    /** @test */
    public function null_data_updated_situation()
    {
        $response = $this->http->put("situacao/update/{$this->posSituationCreated['id_pos_situacao']}",
        ['nm_pos_situacao' => null]);
        $this->assertEquals(422,$response->getStatusCode());
        $this->assertEquals("O campo nm_pos_situacao é obrigatorio",
        $response->getData()['ds_detalhes']->ds_campos->nm_pos_situacao);
    }

    /** @test */
    public function situation_cannot_updated_with_invalid_data()
    {
        $response = $this->http->put("situacao/update/{$this->posSituationCreated['id_pos_situacao']}",
        ['nm_pos_situacao' => 'olé']);
        $this->assertEquals(422,$response->getStatusCode());
        $this->assertEquals("O campo nm_pos_situacao está inválido",
        $response->getData()['ds_detalhes']->ds_campos->nm_pos_situacao);
    }

    /** @test */
    public function situation_can_be_deleted()
    {
        $posSituacao = PosSituacao::factory()->count(2)->create()->toArray();
        $response = $this->http->delete("situacao/delete/{$posSituacao[1]['id_pos_situacao']}",[]);
        $this->assertEquals(200,$response->getStatusCode());
        $this->notSeeInDatabase('pos_situacao',['id_pos_situacao'=> $posSituacao[1]['id_pos_situacao']]);
        $this->seeInDatabase('pos_situacao',['id_pos_situacao'=> $posSituacao[0]['id_pos_situacao']]);
    }

    /** @test */
    public function situation_cannot_be_deleted_without_id()
    {
        $response = $this->http->delete("situacao/delete/null",[]);
        $this->assertEquals(500,$response->getStatusCode());
    }

    /** @test */
    public function situation_has_many_pos()
    {
        $posSituacao = PosSituacao::factory()->create();
        $pos = Pos::factory()->count(2)->create();
        foreach($pos as $posToAssociate) {
            $posSituacao->pos()->save($posToAssociate);
        }
        $this->assertEquals(2,$posSituacao->pos()->count());
    }

    protected function tearDown() : void
    {
        unset($this->posSituationMaked);
        unset($this->posSituationCreated);
    }
}
