<form method="POST" action="{{ route('settings::user.pass.save') }}"  enctype="multipart/form-data">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">{{ $title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="field-1" class="form-label">Change Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" value="">
                        <input type="hidden" class="form-control" name="id" value="{{ $data ? $data->id : null }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-info waves-effect waves-light">Save changes</button>
        </div>
    </div>
</form>