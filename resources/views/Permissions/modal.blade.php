<div class="modal fade" id="delete-{{$id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <!--Content-->
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Eliminar Permiso</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span arial-hidden="true"> </span>
                </button>
            </div>
            <div class="modal-body">
                Estas seguro que quieres eliminarlo?
            </div>
            <div class="modal-footer justify-content-center">

                <button type="button" class="btn btn-secundary" data-dismiss="modal">Cancelar</button>

                {!!Form::open(['action' =>['PermissionController@destroy', $id], 'method'=> 'delete']) !!}
                {{Form::token()}}
                <button type="submit" class="btn btn-primary">Si</button>
                {!!Form::close()!!}


            </div>

        </div>
        <!--/.Content-->

    </div>
</div>