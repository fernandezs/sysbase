<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GeneroApiTest extends TestCase
{
    use MakeGeneroTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateGenero()
    {
        $genero = $this->fakeGeneroData();
        $this->json('POST', '/api/v1/generos', $genero);

        $this->assertApiResponse($genero);
    }

    /**
     * @test
     */
    public function testReadGenero()
    {
        $genero = $this->makeGenero();
        $this->json('GET', '/api/v1/generos/'.$genero->id);

        $this->assertApiResponse($genero->toArray());
    }

    /**
     * @test
     */
    public function testUpdateGenero()
    {
        $genero = $this->makeGenero();
        $editedGenero = $this->fakeGeneroData();

        $this->json('PUT', '/api/v1/generos/'.$genero->id, $editedGenero);

        $this->assertApiResponse($editedGenero);
    }

    /**
     * @test
     */
    public function testDeleteGenero()
    {
        $genero = $this->makeGenero();
        $this->json('DELETE', '/api/v1/generos/'.$genero->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/generos/'.$genero->id);

        $this->assertResponseStatus(404);
    }
}
