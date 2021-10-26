<div id="librocaja" class="border border-danger p-4">
    <h2 class="text-center display-4 font-weight-bold text-danger">Anexos de Control Interno</h2>
    <h1 class="text-center text-danger font-weight-bold mt-2">Libro Caja</h1>


    <div class="row p-4  mb-3 justify-content-center ">
        <div class="col-5 mb-3">
            <input class="form-control text-center" type="text" v-model="nombre" placeholder="Nombre de la empresa"
                name="">

        </div>
    </div>
    @if ($rol === 'estudiante' or 'docente')
    <a href="#" class="addDiario btn btn-outline-info " @click.prevent="abrirLibro()">Agregar Movimiento</a>

    <a href="#" class="addDiario btn btn-outline-success ml-1 " @click.prevent="guardarLibro()">Guardar Libro Caja</a>

    @endif
    
    <table class="table table-bordered table-sm">
        <thead>
            <tr class="text-center bg-dark">
                <th width="100">Fecha</th>
                <th width="300">Detalle</th>
                <th width="100">Debe</th>
                <th width="100">Haber</th>
                <th width="100">Saldo</th>
                <th class="text-center" v-if="libros_caja.length >=1" colspan="2">ACCIONES</th>
            </tr>
        </thead>
        <tbody is="draggable" group="people" :list="libros_caja" tag="tbody">
            <tr v-for="(caja, index) in libros_caja">
                <td align="left">@{{formatoFecha(caja.fecha)}}</td>
                <td align="left">@{{caja.detalle}}</td>
                <td align="right">@{{decimales( caja.debe)}}</td>
                <td align="right">@{{decimales(caja.haber)}}</td>
                <td align="right">@{{decimales(caja.saldo)}}</td>
                <td align="center" width="50">
                    <a @click.prevent="editlibrocajafuera(index)" class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                <td align="center" width="50">
                    <a @click.prevent="WarningEliminarLibro(index)" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
            <tr class="bg-secondary">
                <td class="text-left font-weight-bold">SUMAN</td>
                <td class="text-left font-weight-bold"></td>
                <td class="text-right font-weight-bold">@{{ suman.debe }}</td>
                <td class="text-right font-weight-bold">@{{ suman.haber }}</td>
            </tr>
        </tbody>
    </table>
  
    @if ($rol === 'estudiante' or 'docente')

    <div class="row justify-content-center mb-2">
        <a href="#" class="addDiario btn btn-outline-info " @click.prevent="abrirLibro()">Agregar Movimiento</a>
    </div>

    <div class="row justify-content-center">
        <a href="#" class="addDiario btn btn-outline-success " @click.prevent="guardarLibro()">Guardar Libro Caja</a>
    </div>
    @endif
    <br>
    @include ('contabilidad.modallibrocaja')
</div>