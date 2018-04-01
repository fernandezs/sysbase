<?php

use Faker\Factory as Faker;
use App\Models\Juego;
use App\Repositories\JuegoRepository;

trait MakeJuegoTrait
{
    /**
     * Create fake instance of Juego and save it in database
     *
     * @param array $juegoFields
     * @return Juego
     */
    public function makeJuego($juegoFields = [])
    {
        /** @var JuegoRepository $juegoRepo */
        $juegoRepo = App::make(JuegoRepository::class);
        $theme = $this->fakeJuegoData($juegoFields);
        return $juegoRepo->create($theme);
    }

    /**
     * Get fake instance of Juego
     *
     * @param array $juegoFields
     * @return Juego
     */
    public function fakeJuego($juegoFields = [])
    {
        return new Juego($this->fakeJuegoData($juegoFields));
    }

    /**
     * Get fake data of Juego
     *
     * @param array $postFields
     * @return array
     */
    public function fakeJuegoData($juegoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nombre' => $fake->word,
            'link_gamesfull' => $fake->word,
            'link_mega' => $fake->word,
            'link_drive' => $fake->word,
            'link_ml' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $juegoFields);
    }
}
