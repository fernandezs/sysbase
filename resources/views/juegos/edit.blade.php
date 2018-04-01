@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Juego
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Juego
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($juego, ['route' => ['juegos.update', $juego->id], 'method' => 'patch']) !!}

                        @include('juegos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection