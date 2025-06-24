@section('title', 'Create Server')
@section('styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
@endsection
<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Servers</a></li>
                        <li class="breadcrumb-item"><a href="#">Create</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-1">Create Server</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store" class="row" enctype="multipart/form-data">
                        <div class="col-sm-12 mb-2" wire:ignore>
                            <label for="input-file-now">Image</label>
                            <input type="file" wire:model="image" id="input-file-now" class="dropify"
                                data-height="100" />
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 mb-2">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" wire:model.defer="name"
                                placeholder="Enter server name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                         <div class="col-sm-12 mb-2">
                            <label for="category" class="form-label">category</label>
                            <select class="form-control" id="category" wire:model="category">
                                <option value="" selected>Select Category</option>
                                <option value="speed">Top Speed</option>
                                <option value="download">Fast Download</option>
                                <option value="privacy">Top Privacy</option>
                            </select>
                        </div>
                        <div class="col-sm-12 mb-2">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-control" id="type" wire:model="type">
                                <option value="" selected>Select Type</option>
                                <option value="free">Free</option>
                                <option value="premium">Premium</option>
                                <option value="streaming">Streaming</option>
                            </select>
                        </div>
                        <div class="col-sm-12 mb-2">
                            <label for="Serverstatus" class="form-label">Status</label>
                            <select class="form-control" id="Serverstatus" wire:model="status">
                                <option value="" selected>Select status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-12 mb-2">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input class="form-control" id="longitude" placeholder="Longitude"
                                wire:model.defer="longitude">
                            @error('longitude')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-2">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control" id="latitude" placeholder="Latitude"
                                wire:model.defer="latitude">
                            @error('latitude')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <label for="latitude" class="form-label">Platforms</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" wire:model="android" type="checkbox"
                                    id="flexSwitchCheckChecked">
                                <label class="form-check-label" for="flexSwitchCheckChecked">Android</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" wire:model="ios" type="checkbox"
                                    id="flexSwitchCheckCheckedIos">
                                <label class="form-check-label" for="flexSwitchCheckCheckedIos">iOS</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" wire:model="macos" type="checkbox"
                                    id="flexSwitchCheckCheckedMacos">
                                <label class="form-check-label" for="flexSwitchCheckCheckedMacos">macOS</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" wire:model="windows" type="checkbox"
                                    id="flexSwitchCheckCheckedWindows">
                                <label class="form-check-label" for="flexSwitchCheckCheckedWindows">Windows</label>
                            </div>
                        </div>

                        <div class="col-12 mb-2">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/pages/upload.init.js') }}"></script>
@endsection
