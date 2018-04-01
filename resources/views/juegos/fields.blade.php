<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Link Gamesfull Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link_gamesfull', 'Link Gamesfull:') !!}
    {!! Form::text('link_gamesfull', null, ['class' => 'form-control']) !!}
</div>

<!-- Link Mega Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link_mega', 'Link Mega:') !!}
    {!! Form::text('link_mega', null, ['class' => 'form-control']) !!}
</div>

<!-- Link Drive Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link_drive', 'Link Drive:') !!}
    {!! Form::text('link_drive', null, ['class' => 'form-control']) !!}
</div>

<!-- Link Ml Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link_ml', 'Link Mercado Libre:') !!}
    {!! Form::text('link_ml', null, ['class' => 'form-control']) !!}
</div>

<!-- Link Mercado Libre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_genero', 'Generos:') !!}
    {!! Form::select('id_genero[]',$generos, null, ['class' => 'form-control', 'multiple']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
    <a href="{!! route('juegos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
