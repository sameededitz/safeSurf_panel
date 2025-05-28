<div>
    <div class="page-content-wrapper ">

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.servers.accounts') }}">VPS
                                        Accounts</a></li>
                                <li class="breadcrumb-item active">Create VPS Account</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Create VPS Account</h4>
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
                                        <input class="form-control" type="text" placeholder="Enter the Title "
                                            id="example-text-input" wire:model='name'>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Vps Servers</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="vpsserverId" wire:model='vpsserverId'>
                                            <option value="" selected>Select Vps Server</option>
                                            @foreach ($vpsservers as $server)
                                                <option value="{{ $server->id }}">{{ $server->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="type" wire:model.live='type'>
                                            <option value="" selected>Select type</option>
                                            <option value="open">Open Vpn</option>
                                            <option value="wireguard">Wire Guard</option>
                                            <option value="ikev2">IKEv2</option>
                                        </select>
                                    </div>
                                </div>
                                @if ($type !== 'wireguard')
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="password"
                                                placeholder="Enter the Description" id="password"
                                                wire:model='password'>
                                        </div>
                                    </div>
                                @endif
                                <div class="d-flex justify-content-end mb-2">
                                    <button type="submit" class="btn btn-light waves-effect">Create Vps Server</button>
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
        // Listen for snackbar event and show snackbar
        $wire.on('snackbar', (event) => {
            showSnackbar(event.message, event.type);
        });

        // Listen for redirect event and redirect after 1 second
        $wire.on('redirect', (event) => {
            setTimeout(() => {
                window.location.href = event.url;
            }, 1000);
        });

        $wire.on("sweetToast", (event) => {
            Swal.fire({
                title: event.title,
                text: event.message,
                icon: event.type,
            });
        });
    </script>
    </script>
@endscript
