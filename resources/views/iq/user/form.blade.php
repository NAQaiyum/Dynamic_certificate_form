<form method="POST" action="{{ route('settings::user.save') }}"  enctype="multipart/form-data">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">{{ $title }}</h4>
            <button type="button" class="btn-close fas fa-times" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="field-1" class="form-label">Image</label> <br />
                        <img src="{{ asset($data ? $data->image : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg' ) }}" style="height: 150px; margin-bottom:10px;" id="icon">
                        <input type="file" class="form-control" accept="image/png, image/gif, image/jpeg" name="image" onchange="document.getElementById('icon').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="field-1" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder=" Name" value="{{ $data ? $data->name : null }}">
                        @if($data)
                        <input type="hidden" class="form-control" name="id" value="{{ $data ? $data->id : null }}">
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="field-1" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $data ? $data->email : null }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="field-1" class="form-label">Phone</label>
                        <input type="number" class="form-control" name="phone" placeholder="Phone" value="{{ $data ? $data->phone : null }}">
                    </div>
                </div>
                @if(!$data)
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="field-1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" value="">
                    </div>
                </div>
                @endif
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="field-1" class="form-label">Role</label>
                        <select class="form-control" name="role">
                            <option value="">Select Role</option>
                            <option value="Admin" {{$data && $data->role == 'Admin'? 'Selected' : null}}>Admin</option>
                            <option value="HR" {{$data && $data->role == 'HR'? 'Selected' : null}}>HR</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-info waves-effect waves-light">Save changes</button>
        </div>
    </div>
</form>