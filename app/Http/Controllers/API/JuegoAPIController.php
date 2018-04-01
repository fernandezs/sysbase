<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateJuegoAPIRequest;
use App\Http\Requests\API\UpdateJuegoAPIRequest;
use App\Models\Juego;
use App\Repositories\JuegoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class JuegoController
 * @package App\Http\Controllers\API
 */

class JuegoAPIController extends AppBaseController
{
    /** @var  JuegoRepository */
    private $juegoRepository;

    public function __construct(JuegoRepository $juegoRepo)
    {
        $this->juegoRepository = $juegoRepo;
    }

    /**
     * Display a listing of the Juego.
     * GET|HEAD /juegos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->juegoRepository->pushCriteria(new RequestCriteria($request));
        $this->juegoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $juegos = $this->juegoRepository->all();

        return $this->sendResponse($juegos->toArray(), 'Juegos recuperado con éxito');
    }

    /**
     * Store a newly created Juego in storage.
     * POST /juegos
     *
     * @param CreateJuegoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateJuegoAPIRequest $request)
    {
        $input = $request->all();

        $juegos = $this->juegoRepository->create($input);

        return $this->sendResponse($juegos->toArray(), 'Juego guardado exitosamente');
    }

    /**
     * Display the specified Juego.
     * GET|HEAD /juegos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Juego $juego */
        $juego = $this->juegoRepository->findWithoutFail($id);

        if (empty($juego)) {
            return $this->sendError('Juego no encontrado');
        }

        return $this->sendResponse($juego->toArray(), 'Juego recuperado con éxito');
    }

    /**
     * Update the specified Juego in storage.
     * PUT/PATCH /juegos/{id}
     *
     * @param  int $id
     * @param UpdateJuegoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJuegoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Juego $juego */
        $juego = $this->juegoRepository->findWithoutFail($id);

        if (empty($juego)) {
            return $this->sendError('Juego no encontrado');
        }

        $juego = $this->juegoRepository->update($input, $id);

        return $this->sendResponse($juego->toArray(), 'Juego actualizado exitosamente');
    }

    /**
     * Remove the specified Juego from storage.
     * DELETE /juegos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Juego $juego */
        $juego = $this->juegoRepository->findWithoutFail($id);

        if (empty($juego)) {
            return $this->sendError('Juego no encontrado');
        }

        $juego->delete();

        return $this->sendResponse($id, 'Juego eliminado exitosamente');
    }
}
