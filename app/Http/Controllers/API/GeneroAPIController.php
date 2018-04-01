<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateGeneroAPIRequest;
use App\Http\Requests\API\UpdateGeneroAPIRequest;
use App\Models\Genero;
use App\Repositories\GeneroRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class GeneroController
 * @package App\Http\Controllers\API
 */

class GeneroAPIController extends AppBaseController
{
    /** @var  GeneroRepository */
    private $generoRepository;

    public function __construct(GeneroRepository $generoRepo)
    {
        $this->generoRepository = $generoRepo;
    }

    /**
     * Display a listing of the Genero.
     * GET|HEAD /generos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->generoRepository->pushCriteria(new RequestCriteria($request));
        $this->generoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $generos = $this->generoRepository->all();

        return $this->sendResponse($generos->toArray(), 'Generos recuperado con éxito');
    }

    /**
     * Store a newly created Genero in storage.
     * POST /generos
     *
     * @param CreateGeneroAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateGeneroAPIRequest $request)
    {
        $input = $request->all();

        $generos = $this->generoRepository->create($input);

        return $this->sendResponse($generos->toArray(), 'Genero guardado exitosamente');
    }

    /**
     * Display the specified Genero.
     * GET|HEAD /generos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Genero $genero */
        $genero = $this->generoRepository->findWithoutFail($id);

        if (empty($genero)) {
            return $this->sendError('Genero no encontrado');
        }

        return $this->sendResponse($genero->toArray(), 'Genero recuperado con éxito');
    }

    /**
     * Update the specified Genero in storage.
     * PUT/PATCH /generos/{id}
     *
     * @param  int $id
     * @param UpdateGeneroAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGeneroAPIRequest $request)
    {
        $input = $request->all();

        /** @var Genero $genero */
        $genero = $this->generoRepository->findWithoutFail($id);

        if (empty($genero)) {
            return $this->sendError('Genero no encontrado');
        }

        $genero = $this->generoRepository->update($input, $id);

        return $this->sendResponse($genero->toArray(), 'Genero actualizado exitosamente');
    }

    /**
     * Remove the specified Genero from storage.
     * DELETE /generos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Genero $genero */
        $genero = $this->generoRepository->findWithoutFail($id);

        if (empty($genero)) {
            return $this->sendError('Genero no encontrado');
        }

        $genero->delete();

        return $this->sendResponse($id, 'Genero eliminado exitosamente');
    }
}
