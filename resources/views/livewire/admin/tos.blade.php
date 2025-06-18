@section('title', 'Terms of Service')
<div>
    <div class="page-content-wrapper ">

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route ('admin.tos') }}">Tos</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Tos</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- end page title end breadcrumb -->
            <form wire:submit.prevent="save">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row gy-3">
                            <div class="col-12" wire:ignore>
                                <label class="form-label" for="privacy_policy">Privacy Policy</label>
                                <textarea name="privacy_policy" id="myeditorinstance" wire:model="privacy_policy" class="form-control tinymce-editor"></textarea>
                            </div>
                            <div class="col-12" wire:ignore>
                                <label class="form-label" for="terms_of_service">Terms of Service</label>
                                <textarea id="tosEditor" name="tos" wire:model="tos" class="form-control tinymce-editor"></textarea>
                            </div>
                                </div>
                                <div class="d-flex justify-content-end mb-2">
                                    <button type="submit" class="btn btn-light waves-effect">Save</button>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </form>

        </div><!-- container -->

    </div>
</div>
@script
<script>
    tinymce.init({
        selector: 'textarea.tinymce-editor',
        skin: 'oxide',
        plugins: 'code table lists',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
        setup: function(editor) {
            editor.on('blur', function() {
                let content = editor.getContent();
                let livewireField = editor.getElement().getAttribute('wire:model');
                @this.set(livewireField, content);
            });
            editor.on('change', function() {
                let content = editor.getContent();
                let livewireField = editor.getElement().getAttribute('wire:model');
                @this.set(livewireField, content);
            });
        },
    });

    $wire.on('sweetAlert', (event) => {
        Swal.fire({
            title: event.title,
            text: event.message,
            icon: event.type,
            timer: 2000,
            showConfirmButton: false
        });
    });
</script>
@endscript
@section('scripts')
<script src="https://cdn.tiny.cloud/1/profov2dlbtwaoggjfvbncp77rnjhgyfnl3c2hx3kzpmhif1/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>
@endsection

