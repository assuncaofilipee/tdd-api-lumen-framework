<?php

use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    protected $userMaked;

    public function setUp(): void
    {
        parent::setUp();
        $this->userCreated = User::factory()->create()->toArray();
        $this->userCreated['password'] = 'secret1234';
        $this->userMaked = User::factory()->make()->toArray();
        $this->userMaked['password'] = 'secrect1234';
    }

    /** @test */
    public function user_can_be_created()
    {
          $response = $this->http->post('auth/register',$this->userMaked);
          $this->assertEquals(201,$response->getStatusCode());
          $this->assertNotEmpty($response->getData()['token']);
    }

    /** @test */
    public function user_cannot_be_created_with_invalid_name()
    {
        $this->userMaked['name'] = 'an';
        $response = $this->http->post('auth/register', $this->userMaked);
        $this->assertEquals(422,$response->getStatusCode());
        $this->assertEquals('O nome do usuário deve ser maior do que 3 caracteres',
        $response->getData()['ds_detalhes']->ds_campos->name);
    }

    /** @test */
    public function user_cannot_be_created_with_invalid_email()
    {
        $this->userMaked['email'] = 'adasdn.com';
        $response = $this->http->post('auth/register', $this->userMaked);
        $this->assertEquals(422,$response->getStatusCode());
        $this->assertEquals('O campo E-mail deve conter um email valido',
        $response->getData()['ds_detalhes']->ds_campos->email);
    }

    /** @test */
    public function user_cannot_be_created_with_invalid_password()
    {
        $this->userMaked['password'] = 'ese';
        $response = $this->http->post('auth/register', $this->userMaked);
        $this->assertEquals(422,$response->getStatusCode());
        $this->assertEquals('A senha do usuário deve ser maior do que 6 caracteres',
        $response->getData()['ds_detalhes']->ds_campos->password);
    }

    /** @test */
    public function user_can_be_authenticate()
    {
        $response = $this->http->post('auth/login',$this->userCreated);
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertNotEmpty($response->getData()['token']);
    }

    /** @test */
    public function user_cannot_be_authenticate_with_invalid_email()
    {
        $this->userCreated['email'] = 'dasdsad';
        $response = $this->http->post('auth/login',$this->userCreated);
        $this->assertEquals(422,$response->getStatusCode());
        $this->assertEquals('O campo E-mail deve conter um email valido',
        $response->getData()['ds_detalhes']->ds_campos->email);
    }

    /** @test */
    public function user_cannot_be_authenticate_with_invalid_password()
    {
        $this->userCreated['password'] = '123';
        $response = $this->http->post('auth/login',$this->userCreated);
        $this->assertEquals(422,$response->getStatusCode());
        $this->assertEquals('A senha do usuário deve ser maior do que 6 caracteres',
        $response->getData()['ds_detalhes']->ds_campos->password);
    }

}

