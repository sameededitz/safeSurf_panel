<div>
    <div class="page-content-wrapper ">

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Vps Servers</a></li>
                                <li class="breadcrumb-item active">Edit Vps Server</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Vps Server</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- end page title end breadcrumb -->
            <form wire:submit.prevent="update">
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
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Enter the Name "
                                            id="example-text-input" wire:model='name'>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">IP Address</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Enter the IP Address"
                                            id="example-text-input" wire:model='ip_address'>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-price-input" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Enter the Username"
                                            id="example-price-input" wire:model='username'>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-price-input" class="col-sm-2 col-form-label">Port</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" placeholder="Enter the Port"
                                            id="example-price-input" wire:model='port'>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-price-input" class="col-sm-2 col-form-label">Domain</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Enter the Domain"
                                            id="example-price-input" wire:model='domain'>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" wire:model='status'>
                                            <option value="" selected>Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-price-input" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" placeholder="Enter the Password"
                                            id="example-price-input" wire:model='password'>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-price-input" class="col-sm-2 col-form-label">Private Key</label>
                                    <div class="col-sm-10">
                                        <textarea id="textarea" class="form-control" placeholder="Enter The Private Key" wire:model="private_key"></textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mb-2">
                                    <button type="submit" wire:click="$js.updated()" class="btn btn-light waves-effect">Update VPS Server</button>
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
        $wire.on('snackbar', (event) => {
            showSnackbar(event.message, event.type);
        });
        $wire.on('redirect', (event) => {
            setTimeout(() => {
                window.location.href = event.url;
            }, 1000);
        });
        $js('updated', () => {
            Swal.fire({
                title: 'Updated',
                icon: 'success',
            });
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


