<?php

use App\Models\Juego;
use App\Repositories\JuegoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class JuegoRepositoryTest extends TestCase
{
    use MakeJuegoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var JuegoRepository
     */
    protected $juegoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->juegoRepo = App::make(JuegoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateJuego()
    {
        $juego = $this->fakeJuegoData();
        $createdJuego = $this->juegoRepo->create($juego);
        $createdJuego = $createdJuego->toArray();
        $this->assertArrayHasKey('id', $createdJuego);
        $this->assertNotNull($createdJuego['id'], 'Created Juego must have id specified');
        $this->assertNotNull(Juego::find($createdJuego['id']), 'Juego with given id must be in DB');
        $this->assertModelData($juego, $createdJuego);
    }

    /**
     * @test read
     */
    public function testReadJuego()
    {
        $juego = $this->makeJuego();
        $dbJuego = $this->juegoRepo->find($juego->id);
        $dbJuego = $dbJuego->toArray();
        $this->assertModelData($juego->toArray(), $dbJuego);
    }

    /**
     * @test update
     */
    public function testUpdateJuego()
    {
        $juego = $this->makeJuego();
        $fakeJuego = $this->fakeJuegoData();
        $updatedJuego = $this->juegoRepo->update($fakeJuego, $juego->id);
        $this->assertModelData($fakeJuego, $updatedJuego->toArray());
        $dbJuego = $this->juegoRepo->find($juego->id);
        $this->assertModelData($fakeJuego, $dbJuego->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteJuego()
    {
        $juego = $this->makeJuego();
        $resp = $this->juegoRepo->delete($juego->id);
        $this->assertTrue($resp);
        $this->assertNull(Juego::find($juego->id), 'Juego should not exist in DB');
    }
}
