<div class="modal fade" tabindex="-1" id="kt_modal_1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="d-flex flex-row-reverse px-5 py-2">
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 text-right" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </div>
                <!--end::Close-->
            </div>
            <form id="delete-form" action="{{ route($route, 0) }}" method="POST">
                @method('DELETE')
                @csrf
                <div class="modal-body text-center pt-0 pb-3">
                    <span>Are you sure you want to delete ?</span>
                    <input type="text" id="id" name="id" hidden>
                </div>

                <div class="d-flex justify-content-center py-5">
                    <button type="button" class="mx-2 btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="confirm_delete_btn mx-2 btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>