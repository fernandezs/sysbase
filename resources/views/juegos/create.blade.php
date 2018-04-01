@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Crear Juego
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Crear Juego
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'juegos.store']) !!}

                        @include('juegos.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
