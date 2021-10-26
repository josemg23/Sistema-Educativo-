
{!! Form::hidden('user_id', auth()->user()->id) !!}

<div class="form-group"> 
    {!! Form::label('nombre','Titulo') !!}
    {!! Form::text('nombre', null, ['class'=>'form-control', 'id'=>'nombre']) !!}
</div>
<div class="form-row">

    <div class="form-group col">
        {!! Form::label('category_id','Imagen') !!}
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="image" lang="es">
            <label class="custom-file-label" name="image">Seleccionar Archivo</label>
        </div>
        <small class="form-text text-muted">
            Solo archivos de imágenes de dimensiones 1200x490 px.
        </small>
    </div>
</div>
<div class="form-group">
    {!! Form::label('abstract','Resumen') !!}
    {!! Form::textarea('abstract', null, ['class'=>'form-control', 'rows'=>'3']) !!}
</div>
<div class="form-group"> 
    {!! Form::label('body','Contenido') !!}
    {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
</div>

@section('scripts')
{!! Html::script('vendor/ckeditor/ckeditor.js') !!}
<script>
    CKEDITOR.replace('body');
</script>
@endsection