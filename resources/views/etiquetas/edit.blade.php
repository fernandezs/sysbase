@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Etiqueta
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Etiqueta
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($etiqueta, ['route' => ['etiquetas.update', $etiqueta->id], 'method' => 'patch']) !!}

                        @include('etiquetas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection