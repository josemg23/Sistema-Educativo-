@extends('layouts.nav')
@section('titulo', 'Creador de Lecciones')
@section('content')
<div id="leccion" class="container mb-4">
	<h2 class="text-center display-4 font-weight-bold text-danger">CREAR LECCION</h2>
	<div class=" border mt-1 p-2 bg-secondary">
		<div class="form-row">
			<div class="form-group col-4">
				<label for="recipient-name" class="col-form-label">Institucion:</label>
				<select name="contenido_id" v-model="instituto" class="custom-select select2" @change="onMateria()">
					<option v-if="materias.length == 0" selected disabled="">@{{ instituto }}</option>
					@foreach ($institutos = App\Instituto::get() as $instituto)
					<option value="{{ $instituto->id }}">{{ $instituto->nombre }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group col-4">
				<label for="recipient-name" class="col-form-label">Materia:</label>
				<select name="contenido_id" v-model="materia" class="custom-select" @change="onContenido()">
					<option v-if="contenido.length == 0" disabled>@{{ materia }}</option>
					<option v-for="mate in materias" :value="mate.id">@{{mate.nombre}}</option>
				</select>
			</div>
			<div class="form-group col-4">
				<label for="recipient-name" class="col-form-label">Unidad:</label>
				<select v-model="contenido_id" class="custom-select" required>
					
					<option v-for="conte in contenido" :value="conte.id">@{{conte.nombre}}
					</option>
				</select>
			</div>
			<div class="form-group col-12">
				<label for="recipient-name" class="col-form-label">Enunciado:</label>
				<vue-ckeditor v-model="enunciado" :config="config"/>
				{{--     <textarea v-model="enunciado" name="" id="" cols="15" rows="5" class="form-control"></textarea> --}}
			</div>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-12">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<a class="nav-link active" id="vf-tab" data-toggle="tab" href="#vf" role="tab" aria-controls="vf" aria-selected="true">Verdadero & Falso</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="selecionar-tab" data-toggle="tab" href="#selecionar" role="tab" aria-controls="selecionar" aria-selected="false">Seleccionar Alternativa</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="opcion-tab" data-toggle="tab" href="#opcion" role="tab" aria-controls="opcion" aria-selected="false">Elegir opcion correcta</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="completar-tab" data-toggle="tab" href="#completar" role="tab" aria-controls="completar" aria-selected="false">Completar Enunciados</a>
				</li>
			</ul>
			<div class="tab-content mb-4" id="myTabContent">
				<div class="tab-pane fade show active p-3" id="vf" role="tabpanel" aria-labelledby="vf-tab" style="border: double 8px #3385F5">
					<h3 class="font-weight-bold text-center display-4">Crea los enunciados</h3>
					<div class="form-row">
						<div class="form-group col-md-8">
							{{-- <label for="inputEmail4">Enunciado</label> --}}
							<input v-model="vf.enunciado" type="text" placeholder="Enunciado" class="form-control" >
						</div>
						<div class="form-group col-md-2">
							{{-- <label for="inputPassword4">Respuesta Correcta</label> --}}
							<select class="custom-select" v-model="vf.r_correcta">
								<option value="" disabled="" selected="">ELEGIR V o F</option>
								<option value="v">V</option>
								<option value="f">F</option>
							</select>
						</div>
						<div class="form-group col-md-2">
							<button class="btn btn-danger" @click.prevent="agregarVF()">Crea Enunciado</button>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-12">
							<table class="table">
								<thead class="table-dark">
									<tr>
										<th scope="col">Enunciado</th>
										<th width="125" scope="col">R. Correcta</th>
										<th width="50" scope="col">Accion</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(enun, index) in verdader_falso">
										<td><input type="text" v-model="enun.enunciado" class="form-control form-control-plaintext"></td>
										<td><select v-model=enun.r_correcta class="custom-select">
											<option value="v">V</option>
											<option value="f">F</option>
										</select></td>
										<td><button @click.prevent="eliminarVF(index)" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="tab-pane fade p-3" id="selecionar" role="tabpanel" aria-labelledby="selecionar-tab" style="border: double 8px #3385F5">
					<h3 class="font-weight-bold text-center display-4">AGREGAR</h3>
					  <div class="form-row">
					    <div class="form-group col-md-6">
					      <label for="inputEmail4">Titulo</label>
					      <input v-model="alternativa.titulo" type="text" class="form-control" id="inputEmail4">
					    </div>
					    <div class="form-group col-md-6">
					      <label for="inputPassword4">Alternativa Correcta</label>
					      <select v-model="alternativa.correcta" name="" id=" " class="custom-select">
					      	<option value="" selected="" disabled="">ELEGIR OPCION</option>
					      	<option value="1">ALTERNATIVA 1</option>
					      	<option value="2">ALTERNATIVA 2</option>
					      </select>
					    </div>
					 </div>
					  <div class="form-row">
					    <div class="form-group col-md-12">
							<label for="inputEmail4">Alternativa 1</label>
							<textarea v-model="alternativa.primera" class="form-control"></textarea>
					    </div>
					    <div class="form-group col-md-12">
							<label for="inputEmail4">Alternativa 2</label>
							<textarea v-model="alternativa.segunda" class="form-control"></textarea>
					    </div>
					  </div>
					  <div class="row justify-content-center">
					  	<div class="col-2">
					  		<a href="" class="btn btn-info" @click.prevent="agregarAlternativa()">Agregar</a>
					  	</div>
					  </div>
					  <div class="row mt-2">
					  <div class="col-6" v-for="(alternativa, index) in alternativas" >
					  		<div class="card">
					  <div class="card-header">
					    <input type="text" v-model="alternativa.titulo" class="form-control form-control-plaintext"><a @click.prevent="eliminarAlternativa(index)" class="btn btn-danger" href=""><i class="fa fa-trash"></i></a>
					  </div>
					  <div class="card-body">
					  	<select  v-model="alternativa.r_correcta"  name="" class="form-control-plaintext form-control" id="">
					      	<option value="1">ALTERNATIVA 1</option>
					      	<option value="2">ALTERNATIVA 2</option>
					  	</select>
					    <p class="card-text"><textarea cols="20" rows="5" type="text" class="form-control form-control-plaintext" v-model="alternativa.primera"></textarea></p>
					    <p class="card-text"><textarea cols="20" rows="5" type="text" class="form-control form-control-plaintext" v-model="alternativa.segunda"></textarea></p>
					  </div>
					</div>
					  </div>
					  </div>
				</div>
				<div class="tab-pane fade p-3" id="opcion" role="tabpanel" aria-labelledby="opcion-tab" style="border: double 8px #3385F5">
					  <div class="form-row">
					    <div class="form-group col-md-12">
					      <label for="inputEmail4">Titulo</label>
					      <input type="text" class="form-control"  v-model="selecionar.titulo" >
					    </div>
					        <div class="form-group col-md-12">
					      <label for="inputEmail4">Enunciado Correcto</label>
					      <textarea  v-model="selecionar.correcta" class="form-control"></textarea>
					    </div>
					      <div class="form-group col-md-12">
					      <label for="inputEmail4">Enunciados</label>
					      <textarea  v-model="selecionar.enunciado" class="form-control"></textarea>
					    </div>
					 </div>
					 <div class="row justify-content-center">
					 	<div class="col-2">
					 		<a href="" class="btn btn-info" @click.prevent="agregarSeleccionar()">Agregar</a>
					 	</div>
					 </div>
					 <div class="row mt-4">
					 	<div class="col-12">
					 		<table class="table table-striped">
							  <thead class="table-dark">
							    <tr>
							      <th scope="col">Enunciado</th>
							      <th width="50" scope="col">Accion</th>
							    </tr>
							  </thead>
							  <tbody>
							    <tr v-for="(enunciado, index) in selecionars">
							      <td><textarea class="form-control-plaintext form-control" v-model="enunciado.enunciado"></textarea></td>
							      <td><a href="" class="btn btn-info" @click.prevent="eliminarSeleccion(index)"><i class="fa fa-trash"></i></a></td>
							    </tr>
							  </tbody>
							</table>
					 	</div>
					 </div>
				</div>
				<div class="tab-pane fade p-3" id="completar" role="tabpanel" aria-labelledby="completar-tab" style="border: double 8px #3385F5">
					<h3 class="font-weight-bold text-center display-4">Crea los enunciados</h3>

						<div class="form-row">
					      <div class="form-group col-md-12">
					      <label for="inputEmail4">Enunciados</label>
					      <textarea  v-model="completar.enunciado" class="form-control"></textarea>
					    </div>
					 </div>
					 <div class="row justify-content-center">
					 	<div class="col-2">
					 		<a href="" class="btn btn-info" @click.prevent="agregarCompletar()">Agregar</a>
					 	</div>
					 </div>
					 <div class="row mt-4">
					 	<div class="col-12">
					 		<table class="table table-striped">
							  <thead class="table-dark">
							    <tr>
							      <th scope="col">Enunciado</th>
							      <th width="50" scope="col">Accion</th>
							    </tr>
							  </thead>
							  <tbody>
							    <tr v-for="(completar, index) in completars">
							      <td><textarea class="form-control-plaintext form-control" v-model="completar.enunciado"></textarea></td>
							      <td><a href="" class="btn btn-info" @click.prevent="eliminarCompletar(index)"><i class="fa fa-trash"></i></a></td>
							    </tr>
							  </tbody>
							</table>
					 	</div>
					 </div>
				</div>
			</div>
		</div>
	</div>
	<div class="row mb-5 justify-content-center">
		<div class="col-2">
			<a href="" class="btn btn-outline-info" @click.prevent="crearLeccion()">CREAR LECCION</a>
		</div>
	</div>
</div>
@endsection
@section('js')
<script type="text/javascript">
	const leccion = new Vue({
		el: "#leccion",
		data:{
		instituto: 'Seleccionar el Instituto',
		materia:'Seleccionar una materia',
		materias: [],
		contenido:[],
		value: [],
		vf:{
			enunciado:'',
			r_correcta:''
		},
		alternativa:{
			titulo:'',
			correcta:'',
			primera:'',
			segunda:'',
		},
		selecionar:{
			titulo:'',
			enunciado:'',
			correcta:''
		},
		completar:{
			enunciado:''
		},
		completars:[],
		selecionars:[],
		alternativas:[],
		verdader_falso:[],
		config: {
		toolbar: [
		['Bold', 'Italic', 'Underline', 'Strike', 'Styles', 'TextColor', 'BGColor', 'UIColor' , 'JustifyLeft' , 'JustifyCenter' , 'JustifyRight' , 'JustifyBlock' , 'BidiLtr' , 'BidiRtl' , 'NumberedList' , 'BulletedList' , 'Outdent' , 'Indent' , 'Blockquote' , 'CreateDiv','Format','Font','FontSize']
		],
		height: 300,
		// extraPlugins: 'colorbutton,colordialog'
		},
		contenido_id:'',
		enunciado:'',
},
methods:{
		crearLeccion(){
				let set = this;

			if (set.contenido_id == '' ) {
                 toastr.error("No has elegido la materia para el taller", "Smarmoddle", {
                    "timeOut": "3000"
                });
            }else if (set.enunciado == '' ) {
                 toastr.error("No has puesto el enunciado para el taller", "Smarmoddle", {
                    "timeOut": "3000"
                });
            }else{
				axios.post('/sistema/admin/leccion', {
				plantilla_id: 50,
				contenido_id: set.contenido_id,
				enunciado: set.enunciado,
				completars: set.completars,
				selecionars: set.selecionars,
				alternativas: set.alternativas,
				verdader_falso: set.verdader_falso,
				option_titulo: set.selecionar.titulo,
				option_correcta: set.selecionar.correcta,
				}).then(response => {
					 window.location = "/sistema/home";
				}).catch(e => {
				console.log(e);
				});
			}
		},
			onMateria() {
				let set = this;
				set.materias = [];
				axios.post('/sistema/materiasasig', {
				id: set.instituto
				}).then(response => {
				set.materias = response.data;
				//console.log(set.materias);
				}).catch(e => {
				console.log(e);
				});
		},
		onContenido(){
			let set = this;
			set.contenido = [];
			axios.post('/sistema/contmateria', {
			id: set.materia
			}).then(response => {
			set.contenido = response.data;
			if (set.contenido == 0) {
			toastr.error("Esta Materia no tiene contenidos", "Smarmoddle", {
			"timeOut": "3000"
			});
			set.materia = 'Seleccionar una materia';
			}
			//console.log(set.contenido);
			}).catch(e => {
			console.log(e);
			});
		},
		agregarAlternativa(){
			if(this.alternativa.titulo == ''){
			toastr.error("No has agregado el titulo", "Smarmoddle", {
			"timeOut": "3000"
			});
		}else if(this.alternativa.correcta == ''){
			toastr.error("No has seleccionado la respuesta correcta", "Smarmoddle", {
				"timeOut": "3000"
			});
		}else if(this.alternativa.primera == ''){
			toastr.error("No has agregado la primera alternativa", "Smarmoddle", {
				"timeOut": "3000"
			});
		}else if(this.alternativa.segunda == ''){
			toastr.error("No has agregado la primera alternativa", "Smarmoddle", {
				"timeOut": "3000"
			});
		}else {
			let alternativa = {titulo: this.alternativa.titulo, r_correcta: this.alternativa.correcta, primera: this.alternativa.primera, segunda: this.alternativa.segunda}
			this.alternativas.push(alternativa)
			this.alternativa.titulo     = '';
			this.alternativa.correcta = '';
			this.alternativa.primera    = '';
			this.alternativa.segunda    = '';
		}	
		},
			agregarSeleccionar(){
			if(this.selecionar.enunciado == ''){
			toastr.error("No has agregado el enunciado", "Smarmoddle", {
			"timeOut": "3000"
			});
		}else{
			let selecionar = { enunciado: this.selecionar.enunciado}
			this.selecionars.push(selecionar)
			this.selecionar.enunciado     = '';
		}	

		},
		agregarCompletar(){
		if(this.completar.enunciado == ''){
			toastr.error("No has agregado el enunciado", "Smarmoddle", {
			"timeOut": "3000"
			});
		}else{
			let completar = { enunciado: this.completar.enunciado}
			this.completars.push(completar)
			this.completar.enunciado     = '';
		}	
		},
		eliminarCompletar(index){
			this.completars.splice(index,1);
				toastr.info("Eliminado Correctamente", "Smarmoddle", {
				"timeOut": "3000"
			});
		},
			eliminarSeleccion(index){
			this.selecionars.splice(index,1);
				toastr.info("Eliminado Correctamente", "Smarmoddle", {
				"timeOut": "3000"
			});
		},
		eliminarAlternativa(index){
			this.alternativas.splice(index,1);
				toastr.info("Eliminado Correctamente", "Smarmoddle", {
				"timeOut": "3000"
			});
		},
			agregarVF(){
		if(this.vf.enunciado == ''){
			toastr.error("No has agregado el enunciado", "Smarmoddle", {
			"timeOut": "3000"
			});
		}else if(this.vf.r_correcta == ''){
			toastr.error("No has seleccionado la respuesta correcta", "Smarmoddle", {
				"timeOut": "3000"
			});
		}else{
			let vf = {enunciado: this.vf.enunciado, r_correcta: this.vf.r_correcta}
			this.verdader_falso.push(vf)
			this.vf.enunciado  = '';
			this.vf.r_correcta = '';
		}	
				},
				eliminarVF(index){
					this.verdader_falso.splice(index,1);
						toastr.info("Eliminado Correctamente", "Smarmoddle", {
			"timeOut": "3000"
			});
				}
			}
});
</script>
@endsection