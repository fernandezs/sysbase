<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEtiquetaAPIRequest;
use App\Http\Requests\API\UpdateEtiquetaAPIRequest;
use App\Models\Etiqueta;
use App\Repositories\EtiquetaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class EtiquetaController
 * @package App\Http\Controllers\API
 */

class EtiquetaAPIController extends AppBaseController
{
    /** @var  EtiquetaRepository */
    private $etiquetaRepository;

    public function __construct(EtiquetaRepository $etiquetaRepo)
    {
        $this->etiquetaRepository = $etiquetaRepo;
    }

    /**
     * Display a listing of the Etiqueta.
     * GET|HEAD /etiquetas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->etiquetaRepository->pushCriteria(new RequestCriteria($request));
        $this->etiquetaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $etiquetas = $this->etiquetaRepository->all();

        return $this->sendResponse($etiquetas->toArray(), 'Etiquetas recuperado con éxito');
    }

    /**
     * Store a newly created Etiqueta in storage.
     * POST /etiquetas
     *
     * @param CreateEtiquetaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEtiquetaAPIRequest $request)
    {
        $input = $request->all();

        $etiquetas = $this->etiquetaRepository->create($input);

        return $this->sendResponse($etiquetas->toArray(), 'Etiqueta guardado exitosamente');
    }

    /**
     * Display the specified Etiqueta.
     * GET|HEAD /etiquetas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Etiqueta $etiqueta */
        $etiqueta = $this->etiquetaRepository->findWithoutFail($id);

        if (empty($etiqueta)) {
            return $this->sendError('Etiqueta no encontrado');
        }

        return $this->sendResponse($etiqueta->toArray(), 'Etiqueta recuperado con éxito');
    }

    /**
     * Update the specified Etiqueta in storage.
     * PUT/PATCH /etiquetas/{id}
     *
     * @param  int $id
     * @param UpdateEtiquetaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEtiquetaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Etiqueta $etiqueta */
        $etiqueta = $this->etiquetaRepository->findWithoutFail($id);

        if (empty($etiqueta)) {
            return $this->sendError('Etiqueta no encontrado');
        }

        $etiqueta = $this->etiquetaRepository->update($input, $id);

        return $this->sendResponse($etiqueta->toArray(), 'Etiqueta actualizado exitosamente');
    }

    /**
     * Remove the specified Etiqueta from storage.
     * DELETE /etiquetas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Etiqueta $etiqueta */
        $etiqueta = $this->etiquetaRepository->findWithoutFail($id);

        if (empty($etiqueta)) {
            return $this->sendError('Etiqueta no encontrado');
        }

        $etiqueta->delete();

        return $this->sendResponse($id, 'Etiqueta eliminado exitosamente');
    }
}
