<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class JuegoApiTest extends TestCase
{
    use MakeJuegoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateJuego()
    {
        $juego = $this->fakeJuegoData();
        $this->json('POST', '/api/v1/juegos', $juego);

        $this->assertApiResponse($juego);
    }

    /**
     * @test
     */
    public function testReadJuego()
    {
        $juego = $this->makeJuego();
        $this->json('GET', '/api/v1/juegos/'.$juego->id);

        $this->assertApiResponse($juego->toArray());
    }

    /**
     * @test
     */
    public function testUpdateJuego()
    {
        $juego = $this->makeJuego();
        $editedJuego = $this->fakeJuegoData();

        $this->json('PUT', '/api/v1/juegos/'.$juego->id, $editedJuego);

        $this->assertApiResponse($editedJuego);
    }

    /**
     * @test
     */
    public function testDeleteJuego()
    {
        $juego = $this->makeJuego();
        $this->json('DELETE', '/api/v1/juegos/'.$juego->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/juegos/'.$juego->id);

        $this->assertResponseStatus(404);
    }
}
