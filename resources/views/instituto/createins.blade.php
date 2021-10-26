@extends('layouts.nav')



@section('title', 'Crear Unidad Educativa')

@section('content')




@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> Parece que hay porblemas o Malas decisiones <br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
 <section class="content">
    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
                <h1 class="font-weight-light">Añadir Unidad Educativa</h1>
                <div class="row">
                    <div class="col-md-10">
                        <form method="POST" action="{{route('institutos.index')}} ">
                            @csrf

                            <div class=" card-body">
                                <div class="form-row">
                                    <div class="col">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control"  autocomplete="off" spellcheck="false" name="nombre" id="nombre"
                                            placeholder="Unidad Educativa">
                                    </div>
                                    <div class="col">
                                        <label for="descripcion">Descripción</label>
                                        <input type="text" class="form-control" autocomplete="off" spellcheck="false" name="descripcion" id="descripcion"
                                            placeholder="Descripcion">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="provincia">Provincia</label>
                                        <input type="text" class="form-control"  name="provincia" id="provincia"
                                            placeholder="Provincia">
                                    </div>
                                    <div class="col">
                                        <label for="canton">Cantón</label>
                                        <input type="text" class="form-control" name="canton"  id="canton"
                                            placeholder="Cantón">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" class="form-control" name="direccion"  id="direccion"
                                        placeholder="Dirección">
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" class="form-control" name="telefono"  id="telefono"
                                            placeholder="Télefono">
                                    </div>

                                    <div class="col">
                                        <label for="email">Correo Electrónico </label>
                                        <input type="text" class="form-control" name="email"  id="email"
                                            placeholder="Email">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="nombre">Estado</label><br>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="estadoon" name="estado"   class="custom-control-input"
                                            value="on" @if(old('estado')=="on" ) checked @endif
                                            @if(old('estado')===null) checked @endif>
                                        <label class="custom-control-label" for="estadoon">Activo</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="estadooff" name="estado"  class="custom-control-input"
                                            value="off" @if(old('estado')=="off" ) checked @endif>
                                        <label class="custom-control-label" for="estadooff">No Activo</label>
                                    </div>
                                </div>
                                <a href="{{route('institutos.index')}}" class="btn btn-primary">Atras</a>
                                <input type="submit" class="btn btn-dark " value="Guardar">
                            
                            </div>


                        </form>

                    </div>
                </div>
            </div>

        </div>
</section>


@stop

@section('css')

@stop

@section('js')
{{-- <script type="text/javascript">
    
    const clonar = new Vue({
        el: "#clone",
        data:{
            nombre:'',
            descripcion:'',
            provincia:'',
            canton:'',
            direccion:'',
            telefono:'',
            email:'',
            estado:'',
        },
        methods:{
        clonarInstituto: function() {
        let set = this;
        let url = '/sistema/contenido/clone/1';
        if (set.nombre.trim() === '' || set.descripcion.trim() === '' || set.provincia.trim() === '' || set.canton.trim() === '' || set.direccion.trim() === '' || set.telefono.trim() === '' || set.email.trim() === '' || set.estado.trim() === '') {
            toastr.error("No has ordenado todas las ideas", "Smarmoddle", {
                "timeOut": "3000"
              });
        } else {
        axios.post(url,{
              id: taller_id,
              respuesta: _this.orden
        }).then(response => {
            // console.log(response.data)
            window.location = "/sistema";   
        }).catch(function(error){

        }); 
        }
     
        }
      }
 
    })
</script> --}}
@stop