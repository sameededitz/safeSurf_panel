@section('title', 'Mail Configuration')
<div>
    <div class="page-content-wrapper ">

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.mail-manage') }}">Mail Configuration</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Mail Configuration</h4>
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
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Mail Host</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Enter the Mail Host "
                                            id="example-text-input" wire:model="mail_host">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Mail Port</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Enter the IP Address"
                                            id="example-text-input" wire:model="mail_port">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-price-input" class="col-sm-2 col-form-label">Mail Username</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Enter the Username"
                                            id="example-price-input" wire:model="mail_username">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-price-input" class="col-sm-2 col-form-label">Mail Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Enter the Port"
                                            id="example-price-input" wire:model="mail_password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-price-input" class="col-sm-2 col-form-label">Mail Form Address</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Enter the Domain"
                                            id="example-price-input" wire:model="mail_from_address">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-price-input" class="col-sm-2 col-form-label">Mail Form Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Enter the Domain"
                                            id="example-price-input" wire:model="mail_from_name">
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
        $wire.on('redirect', (event) => {
            setTimeout(() => {
                window.location.href = event.url;
            }, 1000);
        });
    </script>
@endscript