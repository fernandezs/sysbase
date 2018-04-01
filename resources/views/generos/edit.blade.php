@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Genero
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Genero
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($genero, ['route' => ['generos.update', $genero->id], 'method' => 'patch']) !!}

                        @include('generos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection