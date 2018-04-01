<?php

use App\Models\Genero;
use App\Repositories\GeneroRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GeneroRepositoryTest extends TestCase
{
    use MakeGeneroTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var GeneroRepository
     */
    protected $generoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->generoRepo = App::make(GeneroRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateGenero()
    {
        $genero = $this->fakeGeneroData();
        $createdGenero = $this->generoRepo->create($genero);
        $createdGenero = $createdGenero->toArray();
        $this->assertArrayHasKey('id', $createdGenero);
        $this->assertNotNull($createdGenero['id'], 'Created Genero must have id specified');
        $this->assertNotNull(Genero::find($createdGenero['id']), 'Genero with given id must be in DB');
        $this->assertModelData($genero, $createdGenero);
    }

    /**
     * @test read
     */
    public function testReadGenero()
    {
        $genero = $this->makeGenero();
        $dbGenero = $this->generoRepo->find($genero->id);
        $dbGenero = $dbGenero->toArray();
        $this->assertModelData($genero->toArray(), $dbGenero);
    }

    /**
     * @test update
     */
    public function testUpdateGenero()
    {
        $genero = $this->makeGenero();
        $fakeGenero = $this->fakeGeneroData();
        $updatedGenero = $this->generoRepo->update($fakeGenero, $genero->id);
        $this->assertModelData($fakeGenero, $updatedGenero->toArray());
        $dbGenero = $this->generoRepo->find($genero->id);
        $this->assertModelData($fakeGenero, $dbGenero->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteGenero()
    {
        $genero = $this->makeGenero();
        $resp = $this->generoRepo->delete($genero->id);
        $this->assertTrue($resp);
        $this->assertNull(Genero::find($genero->id), 'Genero should not exist in DB');
    }
}
