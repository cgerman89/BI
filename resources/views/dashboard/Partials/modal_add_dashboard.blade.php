<!-- Modal -->
<div id="modal_add_dashboard" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content center-block">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Dashboard</h4>
            </div>
            <div class="modal-body">
                @include('dashboard.Partials.form_create_dashboard')
            </div>
            <div class="modal-footer">
                <button class="btn btn-default pull-left" data-dismiss="modal">
                    <i class="fas fa-times"></i> &nbsp; Cancel
                </button>
                <button class="btn btn-primary" id="btn_save_dashboard">
                    <i class="far fa-save"></i> &nbsp; Save
                </button>
            </div>
        </div>
    </div>
</div>
