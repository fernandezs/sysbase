<?php

use App\Models\Etiqueta;
use App\Repositories\EtiquetaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EtiquetaRepositoryTest extends TestCase
{
    use MakeEtiquetaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var EtiquetaRepository
     */
    protected $etiquetaRepo;

    public function setUp()
    {
        parent::setUp();
        $this->etiquetaRepo = App::make(EtiquetaRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateEtiqueta()
    {
        $etiqueta = $this->fakeEtiquetaData();
        $createdEtiqueta = $this->etiquetaRepo->create($etiqueta);
        $createdEtiqueta = $createdEtiqueta->toArray();
        $this->assertArrayHasKey('id', $createdEtiqueta);
        $this->assertNotNull($createdEtiqueta['id'], 'Created Etiqueta must have id specified');
        $this->assertNotNull(Etiqueta::find($createdEtiqueta['id']), 'Etiqueta with given id must be in DB');
        $this->assertModelData($etiqueta, $createdEtiqueta);
    }

    /**
     * @test read
     */
    public function testReadEtiqueta()
    {
        $etiqueta = $this->makeEtiqueta();
        $dbEtiqueta = $this->etiquetaRepo->find($etiqueta->id);
        $dbEtiqueta = $dbEtiqueta->toArray();
        $this->assertModelData($etiqueta->toArray(), $dbEtiqueta);
    }

    /**
     * @test update
     */
    public function testUpdateEtiqueta()
    {
        $etiqueta = $this->makeEtiqueta();
        $fakeEtiqueta = $this->fakeEtiquetaData();
        $updatedEtiqueta = $this->etiquetaRepo->update($fakeEtiqueta, $etiqueta->id);
        $this->assertModelData($fakeEtiqueta, $updatedEtiqueta->toArray());
        $dbEtiqueta = $this->etiquetaRepo->find($etiqueta->id);
        $this->assertModelData($fakeEtiqueta, $dbEtiqueta->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteEtiqueta()
    {
        $etiqueta = $this->makeEtiqueta();
        $resp = $this->etiquetaRepo->delete($etiqueta->id);
        $this->assertTrue($resp);
        $this->assertNull(Etiqueta::find($etiqueta->id), 'Etiqueta should not exist in DB');
    }
}
