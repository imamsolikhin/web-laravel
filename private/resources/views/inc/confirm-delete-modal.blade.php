<div class="modal fade" id="confirm-delete-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" role="form" id="confirm-delete-modal-action">
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete this selected data?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-default font-weight-bold" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger font-weight-bold">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#confirm-delete-modal').on('show.bs.modal', function(event){
        $('#confirm-delete-modal-action').attr('action', $(event.relatedTarget).data('href'));
    });
</script>