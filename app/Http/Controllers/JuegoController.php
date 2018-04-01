<?php

namespace App\Http\Controllers;

use App\DataTables\JuegoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateJuegoRequest;
use App\Http\Requests\UpdateJuegoRequest;
use App\Repositories\JuegoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Repositories\GeneroRepository;
class JuegoController extends AppBaseController
{
    /** @var  JuegoRepository */
    private $juegoRepository;
    private $generoRepository;
    public function __construct(JuegoRepository $juegoRepo, GeneroRepository $generoRepo)
    {
        $this->juegoRepository = $juegoRepo;
        $this->generoRepository = $generoRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Juego.
     *
     * @param JuegoDataTable $juegoDataTable
     * @return Response
     */
    public function index(JuegoDataTable $juegoDataTable)
    {
        return $juegoDataTable->render('juegos.index');
    }

    /**
     * Show the form for creating a new Juego.
     *
     * @return Response
     */
    public function create()
    {
        $generos = $this->generoRepository->pluck('genero', 'id');
        return view('juegos.create', compact('generos'));
    }

    /**
     * Store a newly created Juego in storage.
     *
     * @param CreateJuegoRequest $request
     *
     * @return Response
     */
    public function store(CreateJuegoRequest $request)
    {
        $input = $request->all();

        $juego = $this->juegoRepository->create($input);

        Flash::success('Juego guardado exitosamente.');

        return redirect(route('juegos.index'));
    }

    /**
     * Display the specified Juego.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $juego = $this->juegoRepository->findWithoutFail($id);

        if (empty($juego)) {
            Flash::error('Juego no encontrado');

            return redirect(route('juegos.index'));
        }

        return view('juegos.show')->with('juego', $juego);
    }

    /**
     * Show the form for editing the specified Juego.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $juego = $this->juegoRepository->findWithoutFail($id);

        if (empty($juego)) {
            Flash::error('Juego no encontrado');

            return redirect(route('juegos.index'));
        }

        return view('juegos.edit')->with('juego', $juego);
    }

    /**
     * Update the specified Juego in storage.
     *
     * @param  int              $id
     * @param UpdateJuegoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJuegoRequest $request)
    {
        $juego = $this->juegoRepository->findWithoutFail($id);

        if (empty($juego)) {
            Flash::error('Juego no encontrado');

            return redirect(route('juegos.index'));
        }

        $juego = $this->juegoRepository->update($request->all(), $id);

        Flash::success('Juego actualizado exitosamente.');

        return redirect(route('juegos.index'));
    }

    /**
     * Remove the specified Juego from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $juego = $this->juegoRepository->findWithoutFail($id);

        if (empty($juego)) {
            Flash::error('Juego no encontrado');

            return redirect(route('juegos.index'));
        }

        $this->juegoRepository->delete($id);

        Flash::success('Juego eliminado exitosamente.');

        return redirect(route('juegos.index'));
    }
}
