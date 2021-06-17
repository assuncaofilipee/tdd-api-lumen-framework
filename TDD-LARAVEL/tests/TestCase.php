<?php

use Alibin\Laravel\Facades\Http;
use App\Models\User;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected $user;
    protected $userToken;
    protected $http;
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->userToken =  User::factory()->create();
        $this->userToken = $this->userToken->toArray();
        $this->userToken['password'] = 'secret1234';
        $this->http = $this->request();

    }
    /**
     * Pega o token do usuário logado
     *
     * @return String
     */
    private function token()
    {
        $response = Http::post('auth/login',$this->userToken);
        return $response->getData()['token'];
    }

    /**
     * Monta a header para as requisições do testes
     *
     * @return \Alibin\Laravel\Facades\Response
     */
    private function request()
    {
        Http::setBaseUri(env('APP_URL'));
        return Http::setHeaders([
            'Authorization' => 'Bearer '.$this->token(),
            'Accept' => 'application/json',
        ]);
    }

    protected function tearDown() : void
    {
        unset($this->user);
        unset($this->userToken);
        unset($this->http);
        parent::tearDown();
    }
}
