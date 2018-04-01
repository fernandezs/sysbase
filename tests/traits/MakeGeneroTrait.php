<?php

use Faker\Factory as Faker;
use App\Models\Genero;
use App\Repositories\GeneroRepository;

trait MakeGeneroTrait
{
    /**
     * Create fake instance of Genero and save it in database
     *
     * @param array $generoFields
     * @return Genero
     */
    public function makeGenero($generoFields = [])
    {
        /** @var GeneroRepository $generoRepo */
        $generoRepo = App::make(GeneroRepository::class);
        $theme = $this->fakeGeneroData($generoFields);
        return $generoRepo->create($theme);
    }

    /**
     * Get fake instance of Genero
     *
     * @param array $generoFields
     * @return Genero
     */
    public function fakeGenero($generoFields = [])
    {
        return new Genero($this->fakeGeneroData($generoFields));
    }

    /**
     * Get fake data of Genero
     *
     * @param array $postFields
     * @return array
     */
    public function fakeGeneroData($generoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'genero' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $generoFields);
    }
}
