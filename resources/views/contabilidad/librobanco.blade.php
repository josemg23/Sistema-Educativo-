<div id="librosbanco" class="border border-danger p-4">

    <h2 class="text-center display-4 font-weight-bold text-danger">Anexos de Control Interno</h2>
    <h3 class="text-center display-4 font-weight-bold text-danger">Libro Banco</h3>

    <div class="row p-3  mb-2 justify-content-center ">
        <div class="col-5">
            <input class="form-control text-center" type="text" v-model="nombre" placeholder="Nombre de la Empresa"
                name="" required>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <input type="text" class="form-control" v-model="n_banco" placeholder="Nombre Del Banco" align="left"
                required>
        </div>
        <div class="col">
            <input type="text" class="form-control" v-model="c_banco" placeholder="Cuenta de Banco" align="right"
                required>
        </div>
    </div>
    <br>
    @if ($rol === 'estudiante' or 'docente')
    <a href="#" class="addDiario btn btn-outline-info " @click.prevent="abrirLibroB()">Agregar </a>
    <a href="#" class="addDiario btn btn-outline-success ml-1" @click.prevent="guardarlbBAnco()">Guardar Libro Banco</a>
    @endif
    <br>
   
    <br>
        <table style="border: hidden" class="table table-bordered table-sm mb-2">
            <thead style="border: hidden">
                <tr style="border: hidden" class="text-center bg-dark">
                    <th width="100">Fecha</th>
                    <th width="300">Detalle</th>
                    <th width="50"><i>Ch/</i></th>
                    <th width="90">Debe</th>
                    <th width="90">Haber</th>
                    <th width="100">Saldo</th>
                    <th class="text-center" v-if="lb_banco.length >=1" colspan="2">ACCIONES</th>
                </tr>
            </thead>
            <tbody style="border: hidden" is="draggable" group="people" :list="lb_banco" tag="tbody">
                <tr style="border: hidden" v-for="(banco, index) in lb_banco">
                    <td align="left">@{{formatoFecha(banco.fecha)}}</td>
                    <td align="left">@{{banco.detalle}}</td>
                    <td align="left">@{{banco.cheque}}</td>
                    <td align="right">@{{decimales(banco.debe)}}</td>
                    <td align="right">@{{decimales(banco.haber)}}</td>
                    <td align="right">@{{decimales(banco.saldo)}}</td>

                    <td align="center" width="50">
                        <a @click.prevent="editLibroBancoFuera(index)" class="btn btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td align="center" width="50">
                        <a @click.prevent="WarningEliminarLibro(index)" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>

                <tr style="border: hidden" class="bg-secondary">
                    <td class="text-center font-weight-bold">SUMAN</td>
                    <td class="text-left font-weight-bold"></td>
                    <td class="text-left font-weight-bold"></td>
                    <td class="text-right font-weight-bold">@{{ suman.debe }}</td>
                    <td class="text-right font-weight-bold">@{{ suman.haber }}</td>
                </tr>

            </tbody>
        </table>
   

    @if ($rol === 'estudiante' or 'docente')
    <div class="row justify-content-center mb-2">
        <a href="#" class="addDiario btn btn-outline-info " @click.prevent="abrirLibroB()">Agregar </a>
    </div>

    <div class="row justify-content-center">
        <a href="#" class="addDiario btn btn-outline-success " @click.prevent="guardarlbBAnco()">Guardar Libro Banco</a>
    </div>
    @endif
    <br>

    @include ('contabilidad.modallibrobanco')

</div>