<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EtiquetaApiTest extends TestCase
{
    use MakeEtiquetaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateEtiqueta()
    {
        $etiqueta = $this->fakeEtiquetaData();
        $this->json('POST', '/api/v1/etiquetas', $etiqueta);

        $this->assertApiResponse($etiqueta);
    }

    /**
     * @test
     */
    public function testReadEtiqueta()
    {
        $etiqueta = $this->makeEtiqueta();
        $this->json('GET', '/api/v1/etiquetas/'.$etiqueta->id);

        $this->assertApiResponse($etiqueta->toArray());
    }

    /**
     * @test
     */
    public function testUpdateEtiqueta()
    {
        $etiqueta = $this->makeEtiqueta();
        $editedEtiqueta = $this->fakeEtiquetaData();

        $this->json('PUT', '/api/v1/etiquetas/'.$etiqueta->id, $editedEtiqueta);

        $this->assertApiResponse($editedEtiqueta);
    }

    /**
     * @test
     */
    public function testDeleteEtiqueta()
    {
        $etiqueta = $this->makeEtiqueta();
        $this->json('DELETE', '/api/v1/etiquetas/'.$etiqueta->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/etiquetas/'.$etiqueta->id);

        $this->assertResponseStatus(404);
    }
}
