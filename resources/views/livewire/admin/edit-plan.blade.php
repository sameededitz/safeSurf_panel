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
                                <li class="breadcrumb-item active">Edit Plan</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Plan</h4>
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
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Enter the Description"
                                            id="example-text-input" wire:model='description'>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-price-input" class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" placeholder="Enter the Price"
                                            id="example-price-input" wire:model='price'>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-duration-input" class="col-sm-2 col-form-label">Duration</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" id="example-duration-input"
                                            wire:model='duration' placeholder="Enter the Duration">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Duration Unit</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" wire:model='duration_unit'>
                                            <option>Select Duration Unit</option>
                                            <option value="day">Day</option>
                                            <option value="week">Week</option>
                                            <option value="month">Month</option>
                                            <option value="year">Year</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mb-2">
                                    <button type="submit"  wire:click="$js.updated()" class="btn btn-light waves-effect">Edit Plan</button>
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


