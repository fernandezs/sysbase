@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Crear Etiqueta
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Crear Etiqueta
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'etiquetas.store']) !!}

                        @include('etiquetas.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
