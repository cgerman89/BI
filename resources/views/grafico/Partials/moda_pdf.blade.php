<!-- Modal -->
<div id="modal_previa_pdf" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              @include('grafico.Partials.pdf_view')
            </div>
        </div>
    </div>
</div>
<script>
    const  user_data =  {!! json_encode( auth()->user() ) !!};
</script>