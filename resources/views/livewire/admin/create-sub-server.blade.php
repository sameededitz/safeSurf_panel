@section('title', 'Create Sub Server')
<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Sub Servers</a></li>
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
                    <h4 class="card-title mb-1">Create Sub Server</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store" class="row">
                        <div class="col-sm-12 mb-2">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" wire:model.defer="name"
                                placeholder="Enter server name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 mb-2">
                            <label for="Serverstatus" class="form-label">Status</label>
                            <select class="form-control" id="Serverstatus" wire:model="status">
                                <option value="" selected>Select status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 mb-2">
                            <label for="vps_server_id" class="form-label">Linked VPS Server</label>
                            <select id="vps_server_id" class="form-control" wire:model.defer="vps_server">
                                <option value="" selected>Select a VPS Server</option>
                                @foreach ($vpsServers as $vpsServer)
                                    <option value="{{ $vpsServer->id }}">
                                        {{ $vpsServer->name ?? 'Unnamed VPS' }} ({{ $vpsServer->ip_address }}) -
                                        {{ $vpsServer->status ? 'Active' : 'Inactive' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vps_server')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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