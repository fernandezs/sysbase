@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Crear Genero
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Crear Genero
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'generos.store']) !!}

                        @include('generos.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
