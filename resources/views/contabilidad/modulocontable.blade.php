@extends('layouts.nav')
@section('titulo', 'Creador de plantillas')
@section('css')

@section('content')
<h1 class="text-center text-danger font-weight-bold display-4">Modulo Contable</h1>
<div  id="modulo">
  <div class="form-row mb-1" >
    <div class="col-2">
      <label for="">Elegir el metodo del taller:</label>
    </div>
    <div class="col-2">
      <select name="" id="" v-model="categoria" class="custom-select" @change="elegirCategoria()">
          <option value="" selected disabled>Selecciona Una Categoria</option>
          <option value="individual">Individual</option>
          <option value="secuencial">Concatenado</option>
      </select>
    </div>
  </div>
 <div v-if="individual.active">
     {{-- <h1 class="text-center text-secondary font-weight-bold mt-3">Taller Individual</h1> --}}
    <div class="row" >
        <div class="col-2">
          <label for="">Elegir el taller:</label>
        </div>
        <div class="col-3">
          <select name="" id="" v-model="taller_individual" class="custom-select" @change="elegirCategoria()">
              <option value="" selected disabled>Selecciona un Modulo</option>
              <option value="balance-inicial-vertical">Balance Inicial Vertical</option>
              <option value="balance-inicial-horizontal">Balance Inicial Horizontal</option>
              <option value="kardex-fifo">Kardex Fifo</option>
              <option value="kardex-promedio">Kardex Promedio</option>
              <option value="diario-general">Diario General</option>
              <option value="mayor-general">Mayor General</option>
              <option value="balance-comprobacion">Balance de Comprobacion</option>
              <option value="hoja-trabajo">Hoja de trabajo</option>
              <option value="balance-comprobacion-ajustado">Balance Comprobacion Ajustado</option>
              <option value="estado-resultado">Estado de Resultado</option>
              <option value="balance-general">Balance General</option>
              <option value="asientos-cierre">Asientos de cierre</option>
              <option value="librocaja">Libro Caja</option>
              <option value="conciliacionbancaria">Conciliacion Bancaria</option>
              <option value="arqueocaja">Arqueo Caja</option>
              <option value="librobanco">Libro Banco</option>
              <option value="retencioniva">Retencion IVA</option>
              <option value="nominaempleados">Nomina Empleados</option>
              {{-- <option value="provisiondebeneficio">Probiciones de Beneficio</option> --}}
          </select>
        </div>
      </div>
      <div class="container border mt-1 p-2 bg-secondary">
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
          
      <div class="container border mt-1 mb-3  p-2 bg-info" v-if="taller_individual == 'balance-inicial-vertical'">
        <h2 class="text-center font-weight-bold text-danger">BALANCE INICIAL VERTICAL</h2>

                   
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-2">
              {{-- <h3 class="text-center font-weight-bold text-dark" >Transacciones</h3> --}}
              <vue-ckeditor v-model="individuales.balance_vertical" :config="config"/>
                {{-- <a href="" class="btn btn-danger" @click.prevent="agregar()">Agregar</a> --}}
            </div>
                      <div class="form-group col-12">
                  <label for="recipient-name" class="col-form-label">PDF:</label>
                <input class="custom-file-control"  name="image" type="file" @change="getDoc">
              </div>
            <div class="col-2 mb-2">
                <a href="" class="btn btn-danger btn-block" @click.prevent="crearTaller('balance-inicial-vertical')">Crear Taller</a>
            </div>
        </div>
      </div>
      </div>
      <div class="container border mt-1 mb-3  p-2 bg-info" v-else-if="taller_individual == 'balance-inicial-horizontal'">
        <h2 class="text-center font-weight-bold text-danger">BALANCE INICIAL HORIZONTAL</h2>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-2">
              {{-- <h3 class="text-center font-weight-bold text-ligth" >Transacciones</h3> --}}
              <vue-ckeditor v-model="individuales.balance_horizontal" :config="config"/>
                {{-- <a href="" class="btn btn-danger" @click.prevent="agregar()">Agregar</a> --}}
            </div>
                      <div class="form-group col-12">
                  <label for="recipient-name" class="col-form-label">PDF:</label>
                <input class="custom-file-control"  name="image" type="file" @change="getDoc">
              </div>
            <div class="col-2 mb-2">
                <a href="" class="btn btn-danger btn-block" @click.prevent="crearTaller('balance-inicial-horizontal')">Crear Taller</a>
            </div>
        </div>
      </div>
      </div>
      <div class="container border mt-1 mb-3  p-2 bg-info" v-else-if="taller_individual == 'kardex-fifo'">
        <h2 class="text-center font-weight-bold text-danger">KARDEX FIFO</h2>
           <h2 class="text-center font-weight-bold">Agregar Productos </h2>
              <div class="row justify-content-center">
                <div class="col-4 mb-2">
                    <input autocomplete="ÑÖcompletes" type="text" name="" class="form-control" placeholder="Nombre del producto" v-model="individuales.kardex_fifo.nombre">
                </div>
                  <div class="col-12 mb-2">
                    {{-- <h3 class="text-center font-weight-bold text-ligth" >Transacciones</h3> --}}
                    {{-- <ckeditor style="height: 300px" class="form-control border" :config="editorConfig" v-model="individuales.kardex_fifo.transacciones"></ckeditor> --}}
                    <vue-ckeditor v-model="individuales.kardex_fifo.transacciones" :config="config"/>
                      {{-- <a href="" class="btn btn-danger" @click.prevent="agregar()">Agregar</a> --}}
                  </div>
                  <div class="col-2 mb-2">
                      <a href="" class="btn btn-danger btn-block" @click.prevent="agregarProductoFifo()">Agregar</a>
                  </div>
              </div>
                      
           {{--    <div class="card-deck"> --}}
          <div class="row row-cols-1 row-cols-md-2">
            <div class="col mb-4" v-for="(producto, index) in individuales.kardex_fifos">
                <div class="card text-white bg-dark mb-3" >
                  <div class="card-header">@{{ producto.nombre }}</div>
                  <div class="card-body">
                    <div v-html="producto.transacciones">
                      
                    </div>
                  </div>
                </div>
             
            </div>
          </div>
          <div class="row justify-content-center">
                      <div class="form-group col-12">
                  <label for="recipient-name" class="col-form-label">PDF:</label>
                <input class="custom-file-control"  name="image" type="file" @change="getDoc">
              </div>
            <div class="col-2 mb-2">
                      <a href="" class="btn btn-danger btn-block" @click.prevent="crearTaller('kardex-fifo')">CREAR TALLER</a>
                  </div>
          </div>

      </div>
            <div class="container border mt-1 mb-3  p-2 bg-info" v-else-if="taller_individual == 'kardex-promedio'">
        <h2 class="text-center font-weight-bold text-danger">KARDEX PROMEDIO</h2>
           <h2 class="text-center font-weight-bold">Agregar Productos </h2>
              <div class="row justify-content-center">
                <div class="col-4 mb-2">
                    <input autocomplete="ÑÖcompletes" type="text" name="" class="form-control" placeholder="Nombre del producto" v-model="individuales.kardex_promedio.nombre">
                </div>
                  <div class="col-12 mb-2">
                    {{-- <h3 class="text-center font-weight-bold text-ligth" >Transacciones</h3> --}}
                    {{-- <ckeditor style="height: 300px" class="form-control border" :config="editorConfig" v-model="individuales.kardex_promedio.transacciones"></ckeditor> --}}
                    <vue-ckeditor v-model="individuales.kardex_promedio.transacciones" :config="config"/>
                      {{-- <a href="" class="btn btn-danger" @click.prevent="agregar()">Agregar</a> --}}
                  </div>
                  <div class="col-2 mb-2">
                      <a href="" class="btn btn-danger btn-block" @click.prevent="agregarProducto()">Agregar</a>
                  </div>
              </div>
                      
           {{--    <div class="card-deck"> --}}
          <div class="row row-cols-1 row-cols-md-2">
            <div class="col mb-4" v-for="(producto, index) in individuales.kardex_promedios">
                <div class="card text-white bg-dark mb-3" >
                  <div class="card-header">@{{ producto.nombre }}</div>
                  <div class="card-body">
                    <div v-html="producto.transacciones">
                      
                    </div>
                  </div>
                </div>
             
            </div>
          </div>
           <div class="row justify-content-center">
                      <div class="form-group col-12">
                  <label for="recipient-name" class="col-form-label">PDF:</label>
                <input class="custom-file-control"  name="image" type="file" @change="getDoc">
              </div>
            <div class="col-2 mb-2">
              <a href="" class="btn btn-danger btn-block" @click.prevent="crearTaller('kardex-promedio')">CREAR TALLER</a>
            </div>
          </div>
      </div>

      <div class="container border mt-1 mb-3  p-2 bg-info" v-else-if="taller_individual == 'diario-general'">
        <h2 class="text-center font-weight-bold text-danger">DIARIO GENERAL</h2>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-2">
              {{-- <h3 class="text-center font-weight-bold text-ligth" >Transacciones</h3> --}}
              {{-- <ckeditor style="height: 300px" class="form-control border" :config="editorConfig" v-model="individuales.diario_general"></ckeditor> --}}
              <vue-ckeditor v-model="individuales.diario_general" :config="config"/>
                {{-- <a href="" class="btn btn-danger" @click.prevent="agregar()">Agregar</a> --}}
            </div>
                      <div class="form-group col-12">
                  <label for="recipient-name" class="col-form-label">PDF:</label>
                <input class="custom-file-control"  name="image" type="file" @change="getDoc">
              </div>
            <div class="col-2 mb-2">
                <a href="" class="btn btn-danger btn-block" @click.prevent="crearTaller('diario-general')">Crear Taller</a>
            </div>
        </div>
      </div>
      </div>
      <div class="container border mt-1 mb-3  p-2 bg-info" v-else-if="taller_individual == 'mayor-general'">
        <h2 class="text-center font-weight-bold text-danger">MAYOR GENERAL</h2>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-2">
              <h3 class="text-center font-weight-bold text-ligth" >Transacciones</h3>
              <vue-ckeditor v-model="individuales.mayorgeneral" :config="config"/>
              {{-- <ckeditor style="height: 300px" class="form-control border" :config="editorConfig" v-model="individuales.mayorgeneral"></ckeditor> --}}
                {{-- <a href="" class="btn btn-danger" @click.prevent="agregar()">Agregar</a> --}}
            </div>
                      <div class="form-group col-12">
                  <label for="recipient-name" class="col-form-label">PDF:</label>
                <input class="custom-file-control"  name="image" type="file" @change="getDoc">
              </div>
            <div class="col-2 mb-2">
                <a href="" class="btn btn-danger btn-block" @click.prevent="crearTaller('mayor-general')">Crear Taller</a>
            </div>
        </div>
      </div>
      </div>
      <div class="container border mt-1 mb-3  p-2 bg-info" v-else-if="taller_individual == 'balance-comprobacion'">
        <h2 class="text-center font-weight-bold text-danger">BALANCE COMPROBACION</h2>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-2">
              {{-- <h3 class="text-center font-weight-bold text-ligth" >Transacciones</h3> --}}
              <vue-ckeditor v-model="individuales.balance_comprobacion" :config="config"/>

              {{-- <ckeditor style="height: 300px" class="form-control border" :config="editorConfig" v-model="individuales.mayorgeneral"></ckeditor> --}}
                {{-- <a href="" class="btn btn-danger" @click.prevent="agregar()">Agregar</a> --}}
            </div>
                      <div class="form-group col-12">
                  <label for="recipient-name" class="col-form-label">PDF:</label>
                <input class="custom-file-control"  name="image" type="file" @change="getDoc">
              </div>
            <div class="col-2 mb-2">
                <a href="" class="btn btn-danger btn-block" @click.prevent="crearTaller('balance-comprobacion')">Crear Taller</a>
            </div>
        </div>
      </div>
      </div>

        <div class="container border mt-1 mb-3  p-2 bg-info" v-else-if="taller_individual == 'hoja-trabajo'">
        <h2 class="text-center font-weight-bold text-danger">HOJA DE TRABAJO</h2>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-2">
              {{-- <h3 class="text-center font-weight-bold text-ligth" >Transacciones</h3> --}}
              <vue-ckeditor v-model="individuales.hoja_trabajo" :config="config"/>
              {{-- <ckeditor style="height: 300px" class="form-control border" :config="editorConfig" v-model="individuales.mayorgeneral"></ckeditor> --}}
                {{-- <a href="" class="btn btn-danger" @click.prevent="agregar()">Agregar</a> --}}
            </div>
                      <div class="form-group col-12">
                  <label for="recipient-name" class="col-form-label">PDF:</label>
                <input class="custom-file-control"  name="image" type="file" @change="getDoc">
              </div>
            <div class="col-2 mb-2">
                <a href="" class="btn btn-danger btn-block" @click.prevent="crearTaller('hoja-trabajo')">Crear Taller</a>
            </div>
        </div>
      </div>
      </div>

      <div class="container border mt-1 mb-3  p-2 bg-info" v-else-if="taller_individual == 'balance-comprobacion-ajustado'">
        <h2 class="text-center font-weight-bold text-danger">BALANCE COMPROBACION AJUSTADO</h2>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-2">
              {{-- <h3 class="text-center font-weight-bold text-ligth" >Transacciones</h3> --}}
              <vue-ckeditor v-model="individuales.balance_comprobacion_ajustado" :config="config"/>

              {{-- <ckeditor style="height: 300px" class="form-control border" :config="editorConfig" v-model="individuales.mayorgeneral"></ckeditor> --}}
                {{-- <a href="" class="btn btn-danger" @click.prevent="agregar()">Agregar</a> --}}
            </div>
                      <div class="form-group col-12">
                  <label for="recipient-name" class="col-form-label">PDF:</label>
                <input class="custom-file-control"  name="image" type="file" @change="getDoc">
              </div>
            <div class="col-2 mb-2">
                <a href="" class="btn btn-danger btn-block" @click.prevent="crearTaller('balance-comprobacion-ajustado')">Crear Taller</a>
            </div>
        </div>
      </div>
      </div>

      <div class="container border mt-1 mb-3  p-2 bg-info" v-else-if="taller_individual == 'estado-resultado'">
        <h2 class="text-center font-weight-bold text-danger">ESTADO DE RESULTADO</h2>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-2">
              {{-- <h3 class="text-center font-weight-bold text-ligth" >Transacciones</h3> --}}
              <vue-ckeditor v-model="individuales.estado_resultado" :config="config"/>

              {{-- <ckeditor style="height: 300px" class="form-control border" :config="editorConfig" v-model="individuales.mayorgeneral"></ckeditor> --}}
                {{-- <a href="" class="btn btn-danger" @click.prevent="agregar()">Agregar</a> --}}
            </div>
                      <div class="form-group col-12">
                  <label for="recipient-name" class="col-form-label">PDF:</label>
                <input class="custom-file-control"  name="image" type="file" @change="getDoc">
              </div>
            <div class="col-2 mb-2">
                <a href="" class="btn btn-danger btn-block" @click.prevent="crearTaller('estado-resultado')">Crear Taller</a>
            </div>
        </div>
      </div>
      </div>

      <div class="container border mt-1 mb-3  p-2 bg-info" v-else-if="taller_individual == 'balance-general'">
        <h2 class="text-center font-weight-bold text-danger">BALANCE GENERAL</h2>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-2">
              {{-- <h3 class="text-center font-weight-bold text-ligth" >Transacciones</h3> --}}
              <vue-ckeditor v-model="individuales.balance_general" :config="config"/>

              {{-- <ckeditor style="height: 300px" class="form-control border" :config="editorConfig" v-model="individuales.mayorgeneral"></ckeditor> --}}
                {{-- <a href="" class="btn btn-danger" @click.prevent="agregar()">Agregar</a> --}}
            </div>
                      <div class="form-group col-12">
                  <label for="recipient-name" class="col-form-label">PDF:</label>
                <input class="custom-file-control"  name="image" type="file" @change="getDoc">
              </div>
            <div class="col-2 mb-2">
                <a href="" class="btn btn-danger btn-block" @click.prevent="crearTaller('balance-general')">Crear Taller</a>
            </div>
        </div>
      </div>
      </div>


      <div class="container border mt-1 mb-3  p-2 bg-info" v-else-if="taller_individual == 'asientos-cierre'">
        <h2 class="text-center font-weight-bold text-danger">ASIENTOS CIERRE</h2>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-2">
              {{-- <h3 class="text-center font-weight-bold text-ligth" >Transacciones</h3> --}}
              <vue-ckeditor v-model="individuales.asientos_cierre" :config="config"/>

              {{-- <ckeditor style="height: 300px" class="form-control border" :config="editorConfig" v-model="individuales.mayorgeneral"></ckeditor> --}}
                {{-- <a href="" class="btn btn-danger" @click.prevent="agregar()">Agregar</a> --}}
            </div>
                      <div class="form-group col-12">
                  <label for="recipient-name" class="col-form-label">PDF:</label>
                <input class="custom-file-control"  name="image" type="file" @change="getDoc">
              </div>
            <div class="col-2 mb-2">
                <a href="" class="btn btn-danger btn-block" @click.prevent="crearTaller('asientos-cierre')">Crear Taller</a>
            </div>
        </div>
      </div>
      </div>

      <div class="container border mt-1 mb-3  p-2 bg-info" v-else-if="taller_individual == 'librocaja'">
        <h2 class="text-center font-weight-bold text-danger">Libro Caja</h2>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-2">
              {{-- <h3 class="text-center font-weight-bold text-ligth" >Transacciones</h3> --}}
              <vue-ckeditor v-model="individuales.librocaja" :config="config"/>

              {{-- <ckeditor style="height: 300px" class="form-control border" :config="editorConfig" v-model="individuales.mayorgeneral" @ready="onReady"></ckeditor> --}}
                {{-- <a href="" class="btn btn-danger" @click.prevent="agregar()">Agregar</a> --}}
            </div>
                      <div class="form-group col-12">
                  <label for="recipient-name" class="col-form-label">PDF:</label>
                <input class="custom-file-control"  name="image" type="file" @change="getDoc">
              </div>
            <div class="col-2 mb-2">
                <a href="" class="btn btn-danger btn-block" @click.prevent="crearTaller('librocaja')">Crear Taller</a>
            </div>
        </div>
      </div>
      </div>
            <div class="container border mt-1 mb-3  p-2 bg-info" v-else-if="taller_individual == 'conciliacionbancaria'">
        <h2 class="text-center font-weight-bold text-danger">Conciliacion Bancaria</h2>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-2">
              {{-- <h3 class="text-center font-weight-bold text-ligth" >Transacciones</h3> --}}
              <vue-ckeditor v-model="individuales.conciliacionbancaria" :config="config"/>

              {{-- <ckeditor style="height: 300px" class="form-control border" :config="editorConfig" v-model="individuales.mayorgeneral" @ready="onReady"></ckeditor> --}}
                {{-- <a href="" class="btn btn-danger" @click.prevent="agregar()">Agregar</a> --}}
            </div>
                      <div class="form-group col-12">
                  <label for="recipient-name" class="col-form-label">PDF:</label>
                <input class="custom-file-control"  name="image" type="file" @change="getDoc">
              </div>
            <div class="col-2 mb-2">
                <a href="" class="btn btn-danger btn-block" @click.prevent="crearTaller('conciliacionbancaria')">Crear Taller</a>
            </div>
        </div>
      </div>
      </div>
            <div class="container border mt-1 mb-3  p-2 bg-info" v-else-if="taller_individual == 'arqueocaja'">
        <h2 class="text-center font-weight-bold text-danger">Arqueo Caja</h2>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-2">
              {{-- <h3 class="text-center font-weight-bold text-ligth" >Transacciones</h3> --}}
              <vue-ckeditor v-model="individuales.arqueocaja" :config="config"/>

              {{-- <ckeditor style="height: 300px" class="form-control border" :config="editorConfig" v-model="individuales.mayorgeneral" @ready="onReady"></ckeditor> --}}
                {{-- <a href="" class="btn btn-danger" @click.prevent="agregar()">Agregar</a> --}}
            </div>
                      <div class="form-group col-12">
                  <label for="recipient-name" class="col-form-label">PDF:</label>
                <input class="custom-file-control"  name="image" type="file" @change="getDoc">
              </div>
            <div class="col-2 mb-2">
                <a href="" class="btn btn-danger btn-block" @click.prevent="crearTaller('arqueocaja')">Crear Taller</a>
            </div>
        </div>
      </div>
      </div>
            <div class="container border mt-1 mb-3  p-2 bg-info" v-else-if="taller_individual == 'librobanco'">
        <h2 class="text-center font-weight-bold text-danger">Libro Banco</h2>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-2">
              {{-- <h3 class="text-center font-weight-bold text-ligth" >Transacciones</h3> --}}
              <vue-ckeditor v-model="individuales.librobanco" :config="config"/>

              {{-- <ckeditor style="height: 300px" class="form-control border" :config="editorConfig" v-model="individuales.mayorgeneral" @ready="onReady"></ckeditor> --}}
                {{-- <a href="" class="btn btn-danger" @click.prevent="agregar()">Agregar</a> --}}
            </div>
                      <div class="form-group col-12">
                  <label for="recipient-name" class="col-form-label">PDF:</label>
                <input class="custom-file-control"  name="image" type="file" @change="getDoc">
              </div>
            <div class="col-2 mb-2">
                <a href="" class="btn btn-danger btn-block" @click.prevent="crearTaller('librobanco')">Crear Taller</a>
            </div>
        </div>
      </div>
      </div>
            <div class="container border mt-1 mb-3  p-2 bg-info" v-else-if="taller_individual == 'retencioniva'">
        <h2 class="text-center font-weight-bold text-danger">Retencion IVA</h2>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-2">
              {{-- <h3 class="text-center font-weight-bold text-ligth" >Transacciones</h3> --}}
              <vue-ckeditor v-model="individuales.retencioniva" :config="config"/>

              {{-- <ckeditor style="height: 300px" class="form-control border" :config="editorConfig" v-model="individuales.mayorgeneral" @ready="onReady"></ckeditor> --}}
                {{-- <a href="" class="btn btn-danger" @click.prevent="agregar()">Agregar</a> --}}
            </div>
                      <div class="form-group col-12">
                  <label for="recipient-name" class="col-form-label">PDF:</label>
                <input class="custom-file-control"  name="image" type="file" @change="getDoc">
              </div>
            <div class="col-2 mb-2">
                <a href="" class="btn btn-danger btn-block" @click.prevent="crearTaller('retencioniva')">Crear Taller</a>
            </div>
        </div>
      </div>
      </div>
            <div class="container border mt-1 mb-3  p-2 bg-info" v-else-if="taller_individual == 'nominaempleados'">
        <h2 class="text-center font-weight-bold text-danger">Nomina Empleados</h2>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-2">
              {{-- <h3 class="text-center font-weight-bold text-ligth" >Transacciones</h3> --}}
              <vue-ckeditor v-model="individuales.nominaempleados" :config="config"/>


              {{-- <ckeditor style="height: 300px" class="form-control border" :config="editorConfig" v-model="individuales.mayorgeneral" @ready="onReady"></ckeditor> --}}
                {{-- <a href="" class="btn btn-danger" @click.prevent="agregar()">Agregar</a> --}}
            </div>
                    <div class="form-group col-12">
                  <label for="recipient-name" class="col-form-label">PDF:</label>
                <input class="custom-file-control"  name="image" type="file" @change="getDoc">
              </div>
            <div class="col-2 mb-2">
                <a href="" class="btn btn-danger btn-block" @click.prevent="crearTaller('nominaempleados')">Crear Taller</a>
            </div>
        </div>
      </div>
      </div>
            <div class="container border mt-1 mb-3  p-2 bg-info" v-else-if="taller_individual == 'provisiondebeneficio'">
        <h2 class="text-center font-weight-bold text-danger">Probiciones de Beneficio</h2>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-2">
              {{-- <h3 class="text-center font-weight-bold text-ligth" >Transacciones</h3> --}}
              <vue-ckeditor v-model="individuales.provisiondebeneficio" :config="config"/>
              <div class="form-group">
                  <label for="recipient-name" class="col-form-label">PDF:</label>
                <input class="custom-file-control"  name="image" type="file" @change="getDoc">
              </div>

              {{-- <ckeditor style="height: 300px" class="form-control border" :config="editorConfig" v-model="individuales.mayorgeneral" @ready="onReady"></ckeditor> --}}
                {{-- <a href="" class="btn btn-danger" @click.prevent="agregar()">Agregar</a> --}}
            </div>
            <div class="col-2 mb-2">
                <a href="" class="btn btn-danger btn-block" @click.prevent="crearTaller('provisiondebeneficio')">Crear Taller</a>
            </div>
        </div>
      </div>
      </div>
 </div>
 <div class="mb-3 container" v-else-if="concatenado.active">
         <div class="container border mt-1 p-2 bg-secondary">
     <h1 class="text-center text-light font-weight-bold mt-3">TALLER CONCATENADO</h1>

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
                  
               {{-- <textarea v-model="enunciado" name="" id="" cols="15" rows="5" class="form-control"></textarea> --}}
              </div>
                  <div class="form-group col-12">
                  <label for="recipient-name" class="col-form-label">PDF:</label>
                <input class="custom-file-control"  name="image" type="file" @change="getDoc">
                              
               {{-- <textarea v-model="enunciado" name="" id="" cols="15" rows="5" class="form-control"></textarea> --}}
              </div>
          </div>
          <h4>Modulos a utilizar</h4>
          <multiselect v-model="value" tag-placeholder="Busca un modulo" placeholder="Seleciona los modulos" label="name" track-by="code" :options="options" :multiple="true" :taggable="true"></multiselect>
      </div>


          
     <div class="border mt-3">
          <div class="row mb-3">
            <div class="col-2">
              <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-balance-inicial-list" data-toggle="list" href="#list-balance-inicial" role="tab" aria-controls="balance-inicial">Balance Inicial</a>

                <a class="list-group-item list-group-item-action" id="list-kardex-list" data-toggle="list" href="#list-kardex" role="tab" aria-controls="kardex">Kardex Fifo</a>

                <a class="list-group-item list-group-item-action" id="list-diario-general-list" data-toggle="list" href="#list-diario-general" role="tab" aria-controls="diario-general">Diario General</a>

                <a class="list-group-item list-group-item-action" id="list-arqueo-caja-list" data-toggle="list" href="#list-arqueo-caja" role="tab" aria-controls="arqueo-caja">Arqueo Caja</a>

                <a class="list-group-item list-group-item-action" id="list-conciliacion-bancaria-list" data-toggle="list" href="#list-conciliacion-bancaria" role="tab" aria-controls="conciliacion-bancaria">Conciliacion bancaria</a>

     {{--            <a class="list-group-item list-group-item-action" id="list-mayor-general-list" data-toggle="list" href="#list-mayor-general" role="tab" aria-controls="mayor-general">Mayor General</a>
                <a class="list-group-item list-group-item-action" id="list-balance-comprobacion-list" data-toggle="list" href="#list-balance-comprobacion" role="tab" aria-controls="balance-comprobacion">Balance de Comprobacion</a>
              <a class="list-group-item list-group-item-action" id="list-hoja-trabajo-list" data-toggle="list" href="#list-hoja-trabajo" role="tab" aria-controls="hoja-trabajo">Hoja de trabajo</a>
              <a class="list-group-item list-group-item-action" id="list-balance-comprobacion-ajustado-list" data-toggle="list" href="#list-balance-comprobacion-ajustado" role="tab" aria-controls="balance-comprobacion-ajustado">Balance Comprobacion Ajustado</a>
              <a class="list-group-item list-group-item-action" id="list-estado-resultado-list" data-toggle="list" href="#list-estado-resultado" role="tab" aria-controls="estado-resultado">Estado de Resultado</a>
              <a class="list-group-item list-group-item-action" id="list-balance-general-list" data-toggle="list" href="#list-balance-general" role="tab" aria-controls="balance-general">Balance General</a>
              <a class="list-group-item list-group-item-action" id="list-asientos-cierre-list" data-toggle="list" href="#list-asientos-cierre" role="tab" aria-controls="asientos-cierre">Asientos de cierre</a> --}}
             {{--  <a class="list-group-item list-group-item-action" id="list-anexos-list" data-toggle="list" href="#list-anexos" role="tab" aria-controls="anexos">Anexos</a> --}}

              </div>
            </div>
                  <div class="col-10">
                    <div class="tab-content" id="nav-tabContent">
                      <div class="tab-pane fade show active" id="list-balance-inicial" role="tabpanel" aria-labelledby="list-balance-inicial-list">
                              <h2 class="text-center font-weight-bold text-danger">BALANCE INICIAL</h2>      
                          <div class="container">
                          <div class="row justify-content-center">
                              <div class="col-12 mb-2">
                                {{-- <h3 class="text-center font-weight-bold text-dark" >Transacciones</h3> --}}
                                <vue-ckeditor v-model="concatenados.balance_horizontal" :config="config"/>
                                  {{-- <a href="" class="btn btn-danger" @click.prevent="agregar()">Agregar</a> --}}
                              </div>
                           
                          </div>
                        </div>
                    
                      </div>
                      <div class="tab-pane fade" id="list-kardex" role="tabpanel" aria-labelledby="list-kardex-list">
                              <h2 class="text-center font-weight-bold text-danger">KARDEX FIFO</h2>      

                          <h4 class="text-center font-weight-bold">Agregar Productos </h4>
                          <div class="row justify-content-center">
                            <div class="col-4 mb-2">
                                <input autocomplete="ÑÖcompletes"  type="text" name="" class="form-control" placeholder="Nombre del producto" v-model="concatenados.kardex_fifo.nombre">
                            </div>
                              <div class="col-12 mb-2">
                                {{-- <h3 class="text-center font-weight-bold text-info" >Transacciones</h3> --}}
                                <vue-ckeditor v-model="concatenados.kardex_fifo.transacciones" :config="config"/>
                              </div>
                              <div class="col-2 mb-2">
                                  <a href="" class="btn btn-danger btn-block" @click.prevent="agregarProductoC()">Agregar Producto</a>
                              </div>
                          </div>
                      
                             <div class="row row-cols-1 row-cols-md-2">
                              <div class="col mb-4" v-for="(producto, index) in concatenados.kardex_fifos">
                                  <div class="card text-white bg-dark mb-3" >
                                    <div class="card-header">@{{ producto.nombre }}</div>
                                    <div class="card-body">
                                      <div v-html="producto.transacciones">
                                        
                                      </div>
                                    </div>
                                  </div>
                               
                              </div>
                            </div>

                      </div>
                      <div class="tab-pane fade" id="list-diario-general" role="tabpanel" aria-labelledby="list-diario-general-list">
                              <h2 class="text-center font-weight-bold text-danger">DIARIO GENERAL</h2>
                            <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 mb-2">
                                  {{-- <h3 class="text-center font-weight-bold text-ligth" >Transacciones</h3> --}}
                                  {{-- <ckeditor style="height: 300px" class="form-control border" :config="editorConfig" v-model="individuales.diario_general"></ckeditor> --}}
                                  <vue-ckeditor v-model="concatenados.diario_general" :config="config"/>
                                    {{-- <a href="" class="btn btn-danger" @click.prevent="agregar()">Agregar</a> --}}
                                </div>
                                
                            </div>
                          </div>
                      </div>
                      <div class="tab-pane fade" id="list-conciliacion-bancaria" role="tabpanel" aria-labelledby="list-conciliacion-bancaria-list">
                        <h2 class="text-center font-weight-bold text-danger">CONCILIACION BANCARIA</h2>
                            <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 mb-2">
                                  {{-- <h3 class="text-center font-weight-bold text-ligth" >Transacciones</h3> --}}
                                  <vue-ckeditor v-model="concatenados.conciliacionbancaria" :config="config"/>
                                </div>
                                
                            </div>
                          </div>
                      </div>
                    <div class="tab-pane fade" id="list-arqueo-caja" role="tabpanel" aria-labelledby="list-arqueo-caja-list">
                          <h2 class="text-center font-weight-bold text-danger">ARQUEO CAJA</h2>
                            <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 mb-2">
                                  {{-- <h3 class="text-center font-weight-bold text-ligth" >Transacciones</h3>                                  --}}
                                  <vue-ckeditor v-model="concatenados.arqueocaja" :config="config"/>                              
                                </div>
                                
                            </div>
                          </div>
                      </div>
           {{--             <div class="tab-pane fade" id="list-hoja-trabajo" role="tabpanel" aria-labelledby="list-hoja-trabajo-list">
                        Hoja de trabajo
                      </div>
                       <div class="tab-pane fade" id="list-balance-comprobacion-ajustado" role="tabpanel" aria-labelledby="list-balance-comprobacion-ajustado-list">
                       Balance Comprobacion Ajustado
                      </div>
                        <div class="tab-pane fade" id="list-estado-resultado" role="tabpanel" aria-labelledby="list-estado-resultado-list">
                       Estado Resultado
                      </div>
                       <div class="tab-pane fade" id="list-balance-general" role="tabpanel" aria-labelledby="list-balance-general-list">
                       Balance General
                      </div>
                      <div class="tab-pane fade" id="list-asientos-cierre" role="tabpanel" aria-labelledby="list-asientos-cierre-list">
                       Asientos de Cierre
                      </div>
                      <div class="tab-pane fade" id="list-anexos" role="tabpanel" aria-labelledby="list-anexos-list">
                       Anexos
                      </div> --}}
                    </div>
                  </div>
                </div>
     </div>
     <div class="row mt-2 justify-content-center">
       <div class="col-2 mb-2">
            <a href="" class="btn btn-primary btn-block" @click.prevent="tallerConcatenado()">Crear Taller</a>
        </div>
     </div>
 </div>
</div>

@section('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.10.0/full/ckeditor.js"></script>
<script type="text/javascript">
    let modulo_contable = new Vue({
      el: "#modulo",
  
      data:{
        instituto: 'Seleccionar el Instituto',
        materia:'Seleccionar una materia',
        materias: [],
        contenido:[],
            value: [
      
      ],
      options: [
        { name: 'Balance Inicial Horizontal', code: 'diario' },
        { name: 'Kardex', code: 'kardex' },
        { name: 'Diario General', code: 'messages' },
        { name: 'Mayor General', code: 'mayor-general' },
        { name: 'Balance de Comprobacion', code: 'balance_comp' },
        { name: 'Hoja de Trabajo', code: 'hoja-trabajo' },
        { name: 'Balance Ajustado', code: 'balance-ajustado' },
        { name: 'Estado de Resultado', code: 'estado-resultado' },
        { name: 'Balance General', code: 'balance-general' },
        { name: 'Asientos de Cierre', code: 'asento-cierre' },
        { name: 'Libro Caja', code: 'libro-caja' },
        { name: 'Arqueo Caja', code: 'arqueo-caja' },
        { name: 'Libro Banco', code: 'libro-banco' },
        { name: 'Conciliación Bancaria', code: 'conciliacion-bancaria' },
        { name: 'Retencion del IVA', code: 'retencion-iva' },
        // { name: ' Nomina Empleados', code: 'nomina-empleado' },
        // { name: ' Provisión de Benficios', code: 'provision-beneficio' },
      ],
        contenido_id:'',
        enunciado:'',
        document:'',
        individuales:{
          balance_vertical:'',
          balance_horizontal:'',
          diario_general:'',
          mayorgeneral:'',
          balance_comprobacion:'',
          hoja_trabajo:'',
          balance_comprobacion_ajustado:'',
          estado_resultado:'',
          balance_general:'',
          librocaja:'',
          conciliacionbancaria:'',
          arqueocaja:'',
          librobanco:'',
          retencioniva:'',
          nominaempleados:'',
          provisiondebeneficio:'',
          asientos_cierre:'',
          kardex_promedio:{
            nombre:'',
            transacciones:''
          },
          kardex_fifo:{
            nombre:'',
            transacciones:''
          },
          kardex_fifos:[],
          kardex_promedios:[]
        },
        concatenados:{
          kardex_fifo:{
            nombre:'',
            transacciones:'',
          },
          kardex_fifos:[],
          balance_horizontal:'',
          diario_general:'',
          conciliacionbancaria:'',
          arqueocaja:'',
        },
        kardex_promedios:[],
        kardex_promedio:{
          nombre:'',
          transacciones:'',
        },
        taller_individual:'',
        categoria:'',
        individual:{
            active: false,
        },
        concatenado:{
            active:false,
        },
        comercial:'',
         editorData: '',
         config: {
        toolbar: [
          ['Bold', 'Italic', 'Underline', 'Strike', 'Styles', 'TextColor', 'BGColor', 'UIColor' , 'JustifyLeft' , 'JustifyCenter' , 'JustifyRight' , 'JustifyBlock' , 'BidiLtr' , 'BidiRtl' , 'NumberedList' , 'BulletedList' , 'Outdent' , 'Indent' , 'Blockquote' , 'CreateDiv','Format','Font','FontSize']
        ],
        height: 300,
        // extraPlugins: 'colorbutton,colordialog'
      }
      },
      methods:{
            getDoc(event){
        console.log(event)
                //Asignamos la imagen a  nuestra data
                this.document = event.target.files[0];
                toastr.info("Documento cargado correctamente", "Smarmoddle", {
                    "timeOut": "3000"
                });
                // this.updateAvatar()
        console.log(this.document)
                // 
            },
          onMateria() {
            let set = this;
            set.materias = [];
            axios.post('/sistema/materiataller', {
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
               guardarTaller34: function() {
                let _this = this;
                let url = '/sistema/admin/taller34';
                if (_this.registros.length == 0 ) {
                     toastr.error("No tienes registros para guardar el taller", "Smarmoddle", {
                        "timeOut": "3000"
                    });
                } else if (_this.taller.enunciado.trim() === ''){
                    toastr.error("No puedes dejar campos en blanco", "Smarmoddle", {
                        "timeOut": "3000"
                    });
                }else {
                axios.post(url,{
                registro: _this.registros,
                unidad: _this.taller.unidad_id,
                enunciado: _this.taller.enunciado,
                plantilla: _this.taller.plantilla_id,
                }).then(response => {
                   toastr.success("Taller Creado Correctamente", "Smarmoddle", {
                        "timeOut": "3000"
                    });
                window.location = "/sistema/admin/plantilla/tallercontable";
                     
                }).catch(function(error){
                }); 
                } 
            },
        elegirCategoria(){
            let tipo = this.categoria;
            if (tipo == 'individual') {
                this.concatenado.active = false;
                this.individual.active = true;
            }else if(tipo == 'secuencial'){
                this.taller_individual = 'kardex-promedio';
                this.individual.active = false;
                this.concatenado.active = true;
             
            }
        },
          crearTaller(tipo){
            let set = this;
            if (tipo == 'balance-inicial-vertical') {
                let url = '/sistema/admin/modulo/balance-inicial';
                if (set.individuales.balance_vertical.trim() === '' ) {
                     toastr.error("No has agregado las transacciones del balance", "Smarmoddle", {
                        "timeOut": "3000"
                    });
                }else if (set.enunciado == '' ) {
                 toastr.error("No has puesto el enunciado para el taller", "Smarmoddle", {
                    "timeOut": "3000"
                });
            }else if (set.contenido_id == '' ) {
                     toastr.error("No has elegido la materia para el taller", "Smarmoddle", {
                        "timeOut": "3000"
                    });
                }else{
            let data = new  FormData();
            data.append('documento', this.document);
            data.append('id', this.id_taller);
            data.append('tipo', 'vertical');
            data.append('enunciado', this.enunciado);
            data.append('transacciones', this.individuales.balance_vertical);
            data.append('contenido_id', this.contenido_id);
            data.append('plantilla', 37);
     
                    axios.post(url,data).then(response => {
                   window.location = "/sistema/admin/plantilla/tallercontable";
                     
                }).catch(function(error){
                }); 
                }
             
                }else if(tipo == 'balance-inicial-horizontal'){
                    let url = '/sistema/admin/modulo/balance-inicial';
                    if (set.individuales.balance_horizontal.trim() === '' ) {
                         toastr.error("No has agregado las transacciones del balance", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else if (set.enunciado == '' ) {
                 toastr.error("No has puesto el enunciado para el taller", "Smarmoddle", {
                    "timeOut": "3000"
                });
            }else if (set.contenido_id == '' ) {
                         toastr.error("No has elegido la materia para el taller", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else{
                            let data = new  FormData();
                      data.append('documento', this.document);
                      data.append('id', this.id_taller);
                      data.append('tipo', 'horizontal');
                      data.append('enunciado', this.enunciado);
                      data.append('transacciones', this.individuales.balance_horizontal);
                      data.append('contenido_id', this.contenido_id);
                      data.append('plantilla', 37);
                        axios.post(url,data).then(response => {
                       window.location = "/sistema/admin/plantilla/tallercontable";
                         
                    }).catch(function(error){
                    }); 
                    }
                }else if(tipo == 'kardex-fifo'){
                      let url = '/sistema/admin/modulo/kardex-fifo';
                      if (set.individuales.kardex_fifos.length == 0 ) {
                           toastr.error("No has agregado productos", "Smarmoddle", {
                              "timeOut": "3000"
                          });
                      }else if (set.enunciado == '' ) {
                 toastr.error("No has puesto el enunciado para el taller", "Smarmoddle", {
                    "timeOut": "3000"
                });
            }else if (set.contenido_id == '' ) {
                           toastr.error("No has elegido la materia para el taller", "Smarmoddle", {
                              "timeOut": "3000"
                          });
                      }else{
                      let data = new  FormData();
                      data.append('documento', this.document);
                      data.append('id', this.id_taller);
                      data.append('tipo', 'fifo');
                      data.append('enunciado', this.enunciado);
                      data.append('transacciones', JSON.stringify(this.individuales.kardex_fifos));
                      data.append('contenido_id', this.contenido_id);
                      data.append('plantilla', 37);
                          axios.post(url,data).then(response => {
                         window.location = "/sistema/admin/plantilla/tallercontable";
                           
                      }).catch(function(error){
                      }); 
                      }
                }else if(tipo == 'kardex-promedio'){
                  let url = '/sistema/admin/modulo/kardex-fifo';
                      if (set.individuales.kardex_promedios.length == 0 ) {
                           toastr.error("No has agregado productos", "Smarmoddle", {
                              "timeOut": "3000"
                          });
                      }else if (set.enunciado == '' ) {
                 toastr.error("No has puesto el enunciado para el taller", "Smarmoddle", {
                    "timeOut": "3000"
                });
            }else if (set.contenido_id == '' ) {
                           toastr.error("No has elegido la materia para el taller", "Smarmoddle", {
                              "timeOut": "3000"
                          });
                      }else{
                        let data = new  FormData();
                        data.append('documento', this.document);
                        data.append('id', this.id_taller);
                        data.append('tipo', 'promedio');
                        data.append('enunciado', this.enunciado);
                        data.append('transacciones', JSON.stringify(this.individuales.kardex_promedios));
                        data.append('contenido_id', this.contenido_id);
                        data.append('plantilla', 37);
                          axios.post(url,data).then(response => {
                         window.location = "/sistema/admin/plantilla/tallercontable";
                           
                      }).catch(function(error){
                      }); 
                      }
                }else if(tipo == 'diario-general'){
                   let url = '/sistema/admin/modulo/diario-general';
                    if (set.individuales.diario_general.trim() === '' ) {
                         toastr.error("No has agregado las transacciones del diario", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else if (set.enunciado == '' ) {
                 toastr.error("No has puesto el enunciado para el taller", "Smarmoddle", {
                    "timeOut": "3000"
                });
            }else if (set.contenido_id == '' ) {
                         toastr.error("No has elegido la materia para el taller", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else{
                        let data = new  FormData();
                        data.append('documento', this.document);
                        data.append('id', this.id_taller);
                        data.append('enunciado', this.enunciado);
                        data.append('transacciones', this.individuales.diario_general);
                        data.append('contenido_id', this.contenido_id);
                        data.append('plantilla', 37);
                        axios.post(url,data).then(response => {
                        window.location = "/sistema/admin/plantilla/tallercontable";
                         
                    }).catch(function(error){
                    }); 
                    }
                }else if(tipo == 'mayor-general'){
                       let url = '/sistema/admin/modulo/mayor-general';
                    if (set.individuales.mayorgeneral.trim() === '' ) {
                         toastr.error("No has agregado las transacciones del diario", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else if (set.enunciado == '' ) {
                 toastr.error("No has puesto el enunciado para el taller", "Smarmoddle", {
                    "timeOut": "3000"
                });
            }else if (set.contenido_id == '' ) {
                         toastr.error("No has elegido la materia para el taller", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else{
                        let data = new  FormData();
                        data.append('documento', this.document);
                        data.append('id', this.id_taller);
                        data.append('enunciado', this.enunciado);
                        data.append('transacciones', this.individuales.mayorgeneral);
                        data.append('contenido_id', this.contenido_id);
                        data.append('plantilla', 37);
                        axios.post(url,data).then(response => {
                       window.location = "/sistema/admin/plantilla/tallercontable";
                         
                    }).catch(function(error){
                    }); 
                    }
                }else if(tipo == 'balance-comprobacion'){
                    let url = '/sistema/admin/modulo/balance-comprobacion';
                    if (set.individuales.balance_comprobacion.trim() === '' ) {
                         toastr.error("No has agregado las transacciones del balance", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else if (set.enunciado == '' ) {
                 toastr.error("No has puesto el enunciado para el taller", "Smarmoddle", {
                    "timeOut": "3000"
                });
            }else if (set.contenido_id == '' ) {
                         toastr.error("No has elegido la materia para el taller", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else{
                        let data = new  FormData();
                        data.append('documento', this.document);
                        data.append('id', this.id_taller);
                        data.append('enunciado', this.enunciado);
                        data.append('transacciones', this.individuales.balance_comprobacion);
                        data.append('contenido_id', this.contenido_id);
                        data.append('plantilla', 37);
                        axios.post(url,data).then(response => {
                        window.location = "/sistema/admin/plantilla/tallercontable";
                         
                    }).catch(function(error){
                    }); 
                    }
                }else if(tipo == 'hoja-trabajo'){
                    let url = '/sistema/admin/modulo/hoja-trabajo';
                    if (set.individuales.hoja_trabajo.trim() === '' ) {
                         toastr.error("No has agregado las transacciones a la hoja de trabajo", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else if (set.enunciado == '' ) {
                 toastr.error("No has puesto el enunciado para el taller", "Smarmoddle", {
                    "timeOut": "3000"
                });
            }else if (set.contenido_id == '' ) {
                         toastr.error("No has elegido la materia para el taller", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else{
                        let data = new  FormData();
                        data.append('documento', this.document);
                        data.append('id', this.id_taller);
                        data.append('enunciado', this.enunciado);
                        data.append('transacciones', this.individuales.hoja_trabajo);
                        data.append('contenido_id', this.contenido_id);
                        data.append('plantilla', 37);
                        axios.post(url,data).then(response => {
                       window.location = "/sistema/admin/plantilla/tallercontable";
                         
                    }).catch(function(error){
                    }); 
                    }
                }else if(tipo == 'balance-comprobacion-ajustado'){
                    let url = '/sistema/admin/modulo/balance-comprobacion-ajustado';
                    if (set.individuales.balance_comprobacion_ajustado.trim() === '' ) {
                         toastr.error("No has agregado las transacciones al Balance Ajustado", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else if (set.enunciado == '' ) {
                 toastr.error("No has puesto el enunciado para el taller", "Smarmoddle", {
                    "timeOut": "3000"
                });
            }else if (set.contenido_id == '' ) {
                         toastr.error("No has elegido la materia para el taller", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else{
                        let data = new  FormData();
                        data.append('documento', this.document);
                        data.append('id', this.id_taller);
                        data.append('enunciado', this.enunciado);
                        data.append('transacciones', this.individuales.balance_comprobacion_ajustado);
                        data.append('contenido_id', this.contenido_id);
                        data.append('plantilla', 37);
                        axios.post(url,data).then(response => {
                       window.location = "/sistema/admin/plantilla/tallercontable";
                         
                    }).catch(function(error){
                    }); 
                    }
                }else if(tipo == 'estado-resultado'){
                      let url = '/sistema/admin/modulo/estado-resultado';
                    if (set.individuales.estado_resultado.trim() === '' ) {
                         toastr.error("No has agregado las transacciones al Estado de Resultado", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else if (set.enunciado == '' ) {
                 toastr.error("No has puesto el enunciado para el taller", "Smarmoddle", {
                    "timeOut": "3000"
                });
            }else if (set.contenido_id == '' ) {
                         toastr.error("No has elegido la materia para el taller", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else{
                        let data = new  FormData();
                        data.append('documento', this.document);
                        data.append('id', this.id_taller);
                        data.append('enunciado', this.enunciado);
                        data.append('transacciones', this.individuales.estado_resultado);
                        data.append('contenido_id', this.contenido_id);
                        data.append('plantilla', 37);
                        axios.post(url,data).then(response => {
                       window.location = "/sistema/admin/plantilla/tallercontable";
                         
                    }).catch(function(error){
                    }); 
                    }
                }else if(tipo == 'balance-general'){
                    let url = '/sistema/admin/modulo/balance-general';
                    if (set.individuales.balance_general.trim() === '' ) {
                         toastr.error("No has agregado las transacciones al Balance General", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else if (set.enunciado == '' ) {
                 toastr.error("No has puesto el enunciado para el taller", "Smarmoddle", {
                    "timeOut": "3000"
                });
            }else if (set.contenido_id == '' ) {
                         toastr.error("No has elegido la materia para el taller", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else{
                          let data = new  FormData();
                        data.append('documento', this.document);
                        data.append('id', this.id_taller);
                        data.append('enunciado', this.enunciado);
                        data.append('transacciones', this.individuales.balance_general);
                        data.append('contenido_id', this.contenido_id);
                        data.append('plantilla', 37);
                        axios.post(url,data).then(response => {
                       window.location = "/sistema/admin/plantilla/tallercontable";
                         
                    }).catch(function(error){
                    }); 
                    }
                }else if(tipo == 'asientos-cierre'){
                    let url = '/sistema/admin/modulo/asiento-cierre';
                    if (set.individuales.asientos_cierre.trim() === '' ) {
                         toastr.error("No has agregado las transacciones al Asiento de Cierre", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else if (set.enunciado == '' ) {
                     toastr.error("No has puesto el enunciado para el taller", "Smarmoddle", {
                              "timeOut": "3000"
                          });
                      }else if (set.contenido_id == '' ) {
                         toastr.error("No has elegido la materia para el taller", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else{
                               let data = new  FormData();
                        data.append('documento', this.document);
                        data.append('id', this.id_taller);
                        data.append('enunciado', this.enunciado);
                        data.append('transacciones', this.individuales.asientos_cierre);
                        data.append('contenido_id', this.contenido_id);
                        data.append('plantilla', 37);
                        axios.post(url,data).then(response => {
                       window.location = "/sistema/admin/plantilla/tallercontable";
                         
                    }).catch(function(error){
                    }); 
                    }
                }else if(tipo == 'librocaja'){
                         let url = '/sistema/admin/modulo/librocaja';
                    if (set.individuales.librocaja.trim() === '' ) {
                         toastr.error("No has agregado las transacciones al Asiento de Cierre", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else if (set.enunciado == '' ) {
                     toastr.error("No has puesto el enunciado para el taller", "Smarmoddle", {
                              "timeOut": "3000"
                          });
                      }else if (set.contenido_id == '' ) {
                         toastr.error("No has elegido la materia para el taller", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else{
                        let data = new  FormData();
                        data.append('documento', this.document);
                        data.append('id', this.id_taller);
                        data.append('enunciado', this.enunciado);
                        data.append('transacciones', this.individuales.librocaja);
                        data.append('contenido_id', this.contenido_id);
                        data.append('plantilla', 37);
                        axios.post(url,data).then(response => {
                       window.location = "/sistema/admin/plantilla/tallercontable";
                         
                    }).catch(function(error){
                    }); 
                    }
                }else if(tipo == 'conciliacionbancaria'){
                       let url = '/sistema/admin/modulo/conciliacionbancaria';
                    if (set.individuales.conciliacionbancaria.trim() === '' ) {
                         toastr.error("No has agregado las transacciones al Asiento de Cierre", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else if (set.enunciado == '' ) {
                     toastr.error("No has puesto el enunciado para el taller", "Smarmoddle", {
                              "timeOut": "3000"
                          });
                      }else if (set.contenido_id == '' ) {
                         toastr.error("No has elegido la materia para el taller", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else{
                        let data = new  FormData();
                        data.append('documento', this.document);
                        data.append('id', this.id_taller);
                        data.append('enunciado', this.enunciado);
                        data.append('transacciones', this.individuales.conciliacionbancaria);
                        data.append('contenido_id', this.contenido_id);
                        data.append('plantilla', 37); 
                        axios.post(url,data).then(response => {
                       window.location = "/sistema/admin/plantilla/tallercontable";
                         
                    }).catch(function(error){
                    }); 
                    }
                }else if(tipo == 'arqueocaja'){
                       let url = '/sistema/admin/modulo/arqueocaja';
                    if (set.individuales.arqueocaja.trim() === '' ) {
                         toastr.error("No has agregado las transacciones al Asiento de Cierre", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else if (set.enunciado == '' ) {
                     toastr.error("No has puesto el enunciado para el taller", "Smarmoddle", {
                              "timeOut": "3000"
                          });
                      }else if (set.contenido_id == '' ) {
                         toastr.error("No has elegido la materia para el taller", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else{
                       let data = new  FormData();
                        data.append('documento', this.document);
                        data.append('id', this.id_taller);
                        data.append('enunciado', this.enunciado);
                        data.append('transacciones', this.individuales.arqueocaja);
                        data.append('contenido_id', this.contenido_id);
                        data.append('plantilla', 37); 
                        axios.post(url,data).then(response => {
                       window.location = "/sistema/admin/plantilla/tallercontable";
                         
                    }).catch(function(error){
                    }); 
                    }
                }else if(tipo == 'librobanco'){
                       let url = '/sistema/admin/modulo/librobanco';
                    if (set.individuales.librobanco.trim() === '' ) {
                         toastr.error("No has agregado las transacciones al Asiento de Cierre", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else if (set.enunciado == '' ) {
                     toastr.error("No has puesto el enunciado para el taller", "Smarmoddle", {
                              "timeOut": "3000"
                          });
                      }else if (set.contenido_id == '' ) {
                         toastr.error("No has elegido la materia para el taller", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else{
                           let data = new  FormData();
                        data.append('documento', this.document);
                        data.append('id', this.id_taller);
                        data.append('enunciado', this.enunciado);
                        data.append('transacciones', this.individuales.librobanco);
                        data.append('contenido_id', this.contenido_id);
                        data.append('plantilla', 37); 
                        axios.post(url,data).then(response => {
                       window.location = "/sistema/admin/plantilla/tallercontable";
                         
                    }).catch(function(error){
                    }); 
                    }
                }else if(tipo == 'retencioniva'){
                       let url = '/sistema/admin/modulo/retencioniva';
                    if (set.individuales.retencioniva.trim() === '' ) {
                         toastr.error("No has agregado las transacciones al Asiento de Cierre", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else if (set.enunciado == '' ) {
                     toastr.error("No has puesto el enunciado para el taller", "Smarmoddle", {
                              "timeOut": "3000"
                          });
                      }else if (set.contenido_id == '' ) {
                         toastr.error("No has elegido la materia para el taller", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else{
                                     let data = new  FormData();
                        data.append('documento', this.document);
                        data.append('id', this.id_taller);
                        data.append('enunciado', this.enunciado);
                        data.append('transacciones', this.individuales.retencioniva);
                        data.append('contenido_id', this.contenido_id);
                        data.append('plantilla', 37); 
                        axios.post(url,data).then(response => {
                       window.location = "/sistema/admin/plantilla/tallercontable";
                         
                    }).catch(function(error){
                    }); 
                    }
                }else if(tipo == 'nominaempleados'){
                       let url = '/sistema/admin/modulo/nominaempleados';
                    if (set.individuales.nominaempleados.trim() === '' ) {
                         toastr.error("No has agregado las transacciones al Asiento de Cierre", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else if (set.enunciado == '' ) {
                     toastr.error("No has puesto el enunciado para el taller", "Smarmoddle", {
                              "timeOut": "3000"
                          });
                      }else if (set.contenido_id == '' ) {
                         toastr.error("No has elegido la materia para el taller", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else{
                                    let data = new  FormData();
                        data.append('documento', this.document);
                        data.append('id', this.id_taller);
                        data.append('enunciado', this.enunciado);
                        data.append('transacciones', this.individuales.nominaempleados);
                        data.append('contenido_id', this.contenido_id);
                        data.append('plantilla', 37); 
                        axios.post(url,data).then(response => {
                       window.location = "/sistema/admin/plantilla/tallercontable";
                         
                    }).catch(function(error){
                    }); 
                    }
                }else if(tipo == 'provisiondebeneficio'){
                       let url = '/sistema/admin/modulo/provisiondebeneficio';
                    if (set.individuales.provisiondebeneficio.trim() === '' ) {
                         toastr.error("No has agregado las transacciones al Asiento de Cierre", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else if (set.enunciado == '' ) {
                     toastr.error("No has puesto el enunciado para el taller", "Smarmoddle", {
                              "timeOut": "3000"
                          });
                      }else if (set.contenido_id == '' ) {
                         toastr.error("No has elegido la materia para el taller", "Smarmoddle", {
                            "timeOut": "3000"
                        });
                    }else{
                               let data = new  FormData();
                        data.append('documento', this.document);
                        data.append('id', this.id_taller);
                        data.append('enunciado', this.enunciado);
                        data.append('transacciones', this.individuales.provisiondebeneficio);
                        data.append('contenido_id', this.contenido_id);
                        data.append('plantilla', 37); 
                        axios.post(url,data).then(response => {
                       window.location = "/sistema/admin/plantilla/tallercontable";
                         
                    }).catch(function(error){
                    }); 
                    }
                }
          },
        agregarProducto(){
          if (this.individuales.kardex_promedio.nombre.trim() === '') {
            toastr.error("No has agregado el nombre del producto", "Smarmoddle", {
                "timeOut": "3000"
                });
          }else if(this.individuales.kardex_promedio.transacciones.trim() === '') {
            toastr.error("No has agregado las transacciones", "Smarmoddle", {
                "timeOut": "3000"
                });
          }else{
            let producto = {nombre: this.individuales.kardex_promedio.nombre, transacciones: this.individuales.kardex_promedio.transacciones}
            this.individuales.kardex_promedios.push(producto);
             toastr.success("Producto Agregado", "Smarmoddle", {
                "timeOut": "3000"
                });
             this.individuales.kardex_promedio.nombre ='';
              this.individuales.kardex_promedio.transacciones ='';
          }
        },
        agregarProductoFifo(){
          if (this.individuales.kardex_fifo.nombre.trim() === '') {
            toastr.error("No has agregado el nombre del producto", "Smarmoddle", {
                "timeOut": "3000"
                });
          }else if(this.individuales.kardex_fifo.transacciones.trim() === '') {
            toastr.error("No has agregado las transacciones", "Smarmoddle", {
                "timeOut": "3000"
                });
          }else{
            let producto = {nombre: this.individuales.kardex_fifo.nombre, transacciones: this.individuales.kardex_fifo.transacciones}
            this.individuales.kardex_fifos.push(producto);
             toastr.success("Producto Agregado", "Smarmoddle", {
                "timeOut": "3000"
                });
             this.individuales.kardex_fifo.nombre ='';
              this.individuales.kardex_fifo.transacciones ='';
          }
        },
        agregarProductoC(){
          if (this.concatenados.kardex_fifo.nombre.trim() === '') {
            toastr.error("No has agregado el nombre del producto", "Smarmoddle", {
                "timeOut": "3000"
                });
          }else if(this.concatenados.kardex_fifo.transacciones.trim() === '') {
            toastr.error("No has agregado las transacciones", "Smarmoddle", {
                "timeOut": "3000"
                });
          }else{
            let producto = {nombre: this.concatenados.kardex_fifo.nombre, transacciones: this.concatenados.kardex_fifo.transacciones}
            this.concatenados.kardex_fifos.push(producto);
             toastr.success("Producto Agregado", "Smarmoddle", {
                "timeOut": "3000"
                });
             this.concatenados.kardex_fifo.nombre ='';
              this.concatenados.kardex_fifo.transacciones ='';
          }
        },
            tallerConcatenado(){
            let set = this;
            let url = '/sistema/admin/modulo/taller-concatenado';
            if (set.contenido_id == '' ) {
                 toastr.error("No has elegido la materia para el taller", "Smarmoddle", {
                    "timeOut": "3000"
                });
            }else if (set.enunciado == '' ) {
                 toastr.error("No has puesto el enunciado para el taller", "Smarmoddle", {
                    "timeOut": "3000"
                });
            }else if (set.value.length == 0 ) {
                 toastr.error("No has puesto elegido ni un modulo", "Smarmoddle", {
                    "timeOut": "3000"
                });
            }else{
                let data = new  FormData();
            
                data.append('documento', this.document);
            data.append('id', this.id_taller);
            data.append('enunciado', this.enunciado);
            data.append('productos', JSON.stringify(this.concatenados.kardex_fifos));
            data.append('balance_horizontal', this.concatenados.balance_horizontal);
            data.append('diario_general', this.concatenados.diario_general);
            data.append('conciliacionbancaria', this.concatenados.conciliacionbancaria);
            data.append('arqueocaja', this.concatenados.arqueocaja);
            data.append('contenido_id', this.contenido_id);
            data.append('modulos', JSON.stringify( set.value));
            data.append('plantilla', 37);
     
                axios.post(url, data).then(response => {
             
              window.location = "/sistema/admin/plantilla/tallercontable";
                 //console.log(response.data);
            }).catch(function(error){
            }); 
            }
         
           },
        agregar(){
          this.comercial =  this.editorData;
          this.editorData = ''; 
        }
      }
    
    });
</script>

@endsection

@endsection