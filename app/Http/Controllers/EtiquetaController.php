<?php

namespace App\Http\Controllers;

use App\DataTables\EtiquetaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateEtiquetaRequest;
use App\Http\Requests\UpdateEtiquetaRequest;
use App\Repositories\EtiquetaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class EtiquetaController extends AppBaseController
{
    /** @var  EtiquetaRepository */
    private $etiquetaRepository;

    public function __construct(EtiquetaRepository $etiquetaRepo)
    {
        $this->etiquetaRepository = $etiquetaRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Etiqueta.
     *
     * @param EtiquetaDataTable $etiquetaDataTable
     * @return Response
     */
    public function index(EtiquetaDataTable $etiquetaDataTable)
    {
        return $etiquetaDataTable->render('etiquetas.index');
    }

    /**
     * Show the form for creating a new Etiqueta.
     *
     * @return Response
     */
    public function create()
    {
        return view('etiquetas.create');
    }

    /**
     * Store a newly created Etiqueta in storage.
     *
     * @param CreateEtiquetaRequest $request
     *
     * @return Response
     */
    public function store(CreateEtiquetaRequest $request)
    {
        $input = $request->all();

        $etiqueta = $this->etiquetaRepository->create($input);

        Flash::success('Etiqueta guardado exitosamente.');

        return redirect(route('etiquetas.index'));
    }

    /**
     * Display the specified Etiqueta.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $etiqueta = $this->etiquetaRepository->findWithoutFail($id);

        if (empty($etiqueta)) {
            Flash::error('Etiqueta no encontrado');

            return redirect(route('etiquetas.index'));
        }

        return view('etiquetas.show')->with('etiqueta', $etiqueta);
    }

    /**
     * Show the form for editing the specified Etiqueta.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $etiqueta = $this->etiquetaRepository->findWithoutFail($id);

        if (empty($etiqueta)) {
            Flash::error('Etiqueta no encontrado');

            return redirect(route('etiquetas.index'));
        }

        return view('etiquetas.edit')->with('etiqueta', $etiqueta);
    }

    /**
     * Update the specified Etiqueta in storage.
     *
     * @param  int              $id
     * @param UpdateEtiquetaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEtiquetaRequest $request)
    {
        $etiqueta = $this->etiquetaRepository->findWithoutFail($id);

        if (empty($etiqueta)) {
            Flash::error('Etiqueta no encontrado');

            return redirect(route('etiquetas.index'));
        }

        $etiqueta = $this->etiquetaRepository->update($request->all(), $id);

        Flash::success('Etiqueta actualizado exitosamente.');

        return redirect(route('etiquetas.index'));
    }

    /**
     * Remove the specified Etiqueta from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $etiqueta = $this->etiquetaRepository->findWithoutFail($id);

        if (empty($etiqueta)) {
            Flash::error('Etiqueta no encontrado');

            return redirect(route('etiquetas.index'));
        }

        $this->etiquetaRepository->delete($id);

        Flash::success('Etiqueta eliminado exitosamente.');

        return redirect(route('etiquetas.index'));
    }
}
