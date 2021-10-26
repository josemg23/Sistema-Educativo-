<div>
      <table  class="table table-hover">

                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Unidad</th>
                                                <th scope="col">Taller</th>
                                                <th scope="col">Enunciado</th>
                                                <th scope="col">Estado</th>
                                                <th></th>
                                                <th scope="col">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($tallers as $taller)
                                            <tr>
                                                {{-- <tr v-for="(taller, index) in tallers"> --}}
                                                {{--       <th scope="row"></th>
                                                <td>@{{taller.contenido.nombre}}</td>
                                                <td>@{{taller.nombre}}</td>
                                                <td>@{{taller.plantilla.nombre}}</td>
                                                <td><input type="checkbox" name="toggle" v-bind:checked="taller.estado">
                                                </td> --}}
                                                {{-- <td>{{$taller['estado']}}</td> --}}
                                                {{--     <td> </td>
                                                <td class="table-button ">
                                                    <a class="btn btn-info" :href="'/sistema/taller/' + taller.plantilla.id +'/'+ taller.id"><i class="fas fa-eye"></i></a>
                                                </td>
                                            </tr>--}}

                                                <th scope="row"></th>
                                                <td>{{$taller->contenido->nombre}}</td>
                                                <td>{{$taller['nombre']}}</td>
                                                <td >
                                                    <div class="truncate-overflow ">
                                                        {!!$taller->enunciado!!}
                                                    </div>
                                                    
                                                   </td>
                                                <td>
                                                    <div class="onoffswitch">
                                                        <input type="checkbox" name="onoffswitch"
                                                            wire:change="cambiar({{ $taller->id }})"
                                                            class="onoffswitch-checkbox"
                                                            id="myonoffswitch.{{ $taller->id }}" tabindex="0"
                                                            @if($taller['estado']==1) checked @endif>
                                                        <label class="onoffswitch-label"
                                                            for="myonoffswitch.{{ $taller->id }}">
                                                            <span class="onoffswitch-inner"></span>
                                                            <span class="onoffswitch-switch"></span>
                                                        </label>
                                                    </div>
                                                    {{-- <input type="checkbox" name="toggle" value="{{ $taller->id }}"
                                                    @if ($taller['estado'] == 1)
                                                    checked
                                                    @endif> --}}
                                                </td>
                                                {{-- <td>{{$taller['estado']}}</td> --}}
                                                <td> </td>
                                                <td class="table-button ">
                                                    <a class="btn btn-info"
                                                        href="{{route('taller',['plant'=>$taller->plantilla_id,'id'=>$taller->id])}}"><i
                                                            class="fas fa-eye"></i></a>
                                                    <a class="btn btn-danger" wire:click.prevent="eliminarTaller({{ $taller->id }})"><i
                                                            class="fas fa-trash">

                                                        </i>
                                                    </a>

                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <div class="row justify-content-center mt-3"> {{ $tallers->links() }}</div>
</div>
