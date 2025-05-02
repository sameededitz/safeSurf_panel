<div>
    <div class="page-content-wrapper ">

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Plans</a></li>
                                <li class="breadcrumb-item active">Create User</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Create User</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- end page title end breadcrumb -->
            <form wire:submit.prevent="store">
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
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Enter Your Email"
                                            id="example-text-input" wire:model='email'>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-price-input" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" placeholder="Enter the password"
                                            id="example-price-input" wire:model='password'>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-duration-input" class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" id="example-duration-input"
                                            wire:model='password_confirmation' placeholder="Confirm Password">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mb-2">
                                    <button type="submit" class="btn btn-light waves-effect">Create User</button>
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
    </script>
@endscript


