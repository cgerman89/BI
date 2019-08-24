<!-- Modal -->
<div id="modal_dashboard" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content center-block">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Dashboard</h4>
            </div>
            <div class="modal-body">
                @include('grafico.Partials.form_save_data_graphic')
            </div>
            <div class="modal-footer">
                <button class="btn btn-default pull-left" data-dismiss="modal">
                    <i class="fas fa-times"></i> &nbsp; Cancel
                </button>
                <button class="btn btn-primary" id="btn_save_grafico">
                    <i class="fas fa-folder-plus"></i> &nbsp; Add
                </button>
            </div>
        </div>
    </div>
</div>

