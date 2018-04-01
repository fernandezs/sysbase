<?php

use Faker\Factory as Faker;
use App\Models\Etiqueta;
use App\Repositories\EtiquetaRepository;

trait MakeEtiquetaTrait
{
    /**
     * Create fake instance of Etiqueta and save it in database
     *
     * @param array $etiquetaFields
     * @return Etiqueta
     */
    public function makeEtiqueta($etiquetaFields = [])
    {
        /** @var EtiquetaRepository $etiquetaRepo */
        $etiquetaRepo = App::make(EtiquetaRepository::class);
        $theme = $this->fakeEtiquetaData($etiquetaFields);
        return $etiquetaRepo->create($theme);
    }

    /**
     * Get fake instance of Etiqueta
     *
     * @param array $etiquetaFields
     * @return Etiqueta
     */
    public function fakeEtiqueta($etiquetaFields = [])
    {
        return new Etiqueta($this->fakeEtiquetaData($etiquetaFields));
    }

    /**
     * Get fake data of Etiqueta
     *
     * @param array $postFields
     * @return array
     */
    public function fakeEtiquetaData($etiquetaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'etiqueta' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $etiquetaFields);
    }
}
