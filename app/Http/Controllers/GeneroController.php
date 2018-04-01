<?php

namespace App\Http\Controllers;

use App\DataTables\GeneroDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateGeneroRequest;
use App\Http\Requests\UpdateGeneroRequest;
use App\Repositories\GeneroRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class GeneroController extends AppBaseController
{
    /** @var  GeneroRepository */
    private $generoRepository;

    public function __construct(GeneroRepository $generoRepo)
    {
        $this->generoRepository = $generoRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Genero.
     *
     * @param GeneroDataTable $generoDataTable
     * @return Response
     */
    public function index(GeneroDataTable $generoDataTable)
    {
        return $generoDataTable->render('generos.index');
    }

    /**
     * Show the form for creating a new Genero.
     *
     * @return Response
     */
    public function create()
    {
        return view('generos.create');
    }

    /**
     * Store a newly created Genero in storage.
     *
     * @param CreateGeneroRequest $request
     *
     * @return Response
     */
    public function store(CreateGeneroRequest $request)
    {
        $input = $request->all();

        $genero = $this->generoRepository->create($input);

        Flash::success('Genero guardado exitosamente.');

        return redirect(route('generos.index'));
    }

    /**
     * Display the specified Genero.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $genero = $this->generoRepository->findWithoutFail($id);

        if (empty($genero)) {
            Flash::error('Genero no encontrado');

            return redirect(route('generos.index'));
        }

        return view('generos.show')->with('genero', $genero);
    }

    /**
     * Show the form for editing the specified Genero.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $genero = $this->generoRepository->findWithoutFail($id);

        if (empty($genero)) {
            Flash::error('Genero no encontrado');

            return redirect(route('generos.index'));
        }

        return view('generos.edit')->with('genero', $genero);
    }

    /**
     * Update the specified Genero in storage.
     *
     * @param  int              $id
     * @param UpdateGeneroRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGeneroRequest $request)
    {
        $genero = $this->generoRepository->findWithoutFail($id);

        if (empty($genero)) {
            Flash::error('Genero no encontrado');

            return redirect(route('generos.index'));
        }

        $genero = $this->generoRepository->update($request->all(), $id);

        Flash::success('Genero actualizado exitosamente.');

        return redirect(route('generos.index'));
    }

    /**
     * Remove the specified Genero from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $genero = $this->generoRepository->findWithoutFail($id);

        if (empty($genero)) {
            Flash::error('Genero no encontrado');

            return redirect(route('generos.index'));
        }

        $this->generoRepository->delete($id);

        Flash::success('Genero eliminado exitosamente.');

        return redirect(route('generos.index'));
    }
}
