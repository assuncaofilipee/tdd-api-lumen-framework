<?php

use App\Models\Distribuidor;
use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    protected $distribuidor;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->distribuidor = Distribuidor::factory()->create();
    }

    /** @test */
    public function user_can_be_associate_distributor()
    {
        $response = $this->http->post("user/vincular/distribuidor/{$this->user->id_usuario}/{$this->distribuidor->id_distribuidor}",[]);
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertEquals($this->distribuidor->id_distribuidor,$response->getData()['data']['id_distribuidor']);
    }

    /** @test */
    public function it_cannot_be_associate_distributor_with_user_not_avalaible()
    {
        $distribuidor = Distribuidor::factory()->create();
        $this->user->distribuidor()->associate($distribuidor->first())->save();
        $response = $this->http->post("user/vincular/distribuidor/{$this->user->id_usuario}/{$distribuidor->find(2)->id_distribuidor}",[]);
        $this->assertEquals(trans('user-response.userNotAvailable.message'),$response->getData()['ds_mensagem']);
    }
}

