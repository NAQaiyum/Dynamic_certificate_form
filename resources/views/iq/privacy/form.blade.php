<form method="POST" action="{{ route('about::privacy.save') }}"  enctype="multipart/form-data">
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
                        <label for="field-1" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $data ? $data->title : null }}">
                        <input type="hidden" class="form-control" name="id" placeholder="id" value="{{ $data ? $data->id : null }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="field-1" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="description">{!! $data ? $data->description : null !!}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-info waves-effect waves-light">Save changes</button>
        </div>
    </div>
</form>
<script>
    ClassicEditor
        .create( document.querySelector( '#description' ), {
            // ...
            link: {
                addTargetToExternalLinks: true
            },
            mediaEmbed: {
                previewsInData:true
            },
            ckfinder: {
                uploadUrl: '{{route('ckeditor::upload').'?_token='.csrf_token()}}'
            }
        } )
        .catch( error => {
            console.error( error );
        });
</script>

<style>
.ck ul li{
    list-style-type: disc !important;
    margin-left: 30px;
}
</style>
