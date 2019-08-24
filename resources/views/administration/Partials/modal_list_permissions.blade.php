<!-- Modal -->
<div id="modal_list_permissions" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content center-block">
            <div class="modal-header">
                <h4 class="modal-title"> <i class="far fa-list-alt"></i>&nbsp; Lista de Permisos </h4>
            </div>
            <div class="modal-body" style="height: 350px">
                    @include('administration.Partials.list_permissions')
            </div>
            <div class="modal-footer">
                <hr>
                <button class="btn btn-primary" data-dismiss="modal">
                    <i class="fas fa-times"></i> &nbsp; Salir
                </button>
            </div>
        </div>
    </div>
</div>