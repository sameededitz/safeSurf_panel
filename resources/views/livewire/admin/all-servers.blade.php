@section('title', 'Servers')
<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Servers</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h4 class="card-title">Servers</h4>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <div class="d-flex flex-row align-items-center">
                    <select class="form-control mr-2" name="perpage" wire:model.live="perPage">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <select class="form-control w-100 mr-2" id="statusFilter" wire:model.live="statusFilter">
                        <option value="" selected>Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    <select class="form-control w-100" id="platformFilter" wire:model.live="platformFilter">
                        <option value="" selected>Platform</option>
                        <option value="windows">Windows</option>
                        <option value="macos">Mac</option>
                        <option value="ios">iOS</option>
                        <option value="android">Android</option>
                    </select>
                </div>
                <div class="d-flex justify-content-end mb-2">
                    <a href="{{ route('admin.create.server') }}" class="btn btn-light waves-effect">Create Server</a>
                </div>
            </div>
            <table id="tech-companies-1" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Platforms</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($servers as $server)
                        <tr>
                            <td>{{ $server->id }}</td>
                            <td>
                                <img src="{{ $server->getFirstMediaUrl('image') }}" alt="attachment"
                                    class="rounded border" style="width: 70px; height: 70px; object-fit: cover;" />
                            </td>
                            <td>{{ $server->name }}</td>
                            <td>
                                <span class="badge badge-primary">{{ $server->android ? 'Android' : '' }}</span>
                                <span class="badge badge-secondary">{{ $server->ios ? 'iOS' : '' }}</span>
                                <span class="badge badge-warning">{{ $server->macos ? 'MacOS' : '' }}</span>
                                <span class="badge badge-success">{{ $server->windows ? 'Windows' : '' }}</span>
                            </td>
                            <td>
                                <span class="badge {{ $server->isPremium() ? 'badge-primary' : 'badge-secondary' }}">
                                    {{ ucfirst($server->type) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $server->isActive() ? 'badge-success' : 'badge-danger' }}">
                                    {{ $server->isActive() ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('admin.subServers', $server->id) }}"
                                        class="btn btn-light-success btn-rounded btn-icon me-1 d-inline-flex align-items-center">
                                        <Iconify-icon icon="solar:server-square-broken" width="20"
                                            height="20"></Iconify-icon>
                                    </a>
                                    <a href="{{ route('admin.edit.server', $server->id) }}"
                                        class="btn btn-light-success btn-rounded btn-icon me-1 d-inline-flex align-items-center">
                                        <iconify-icon icon="lucide:edit" width="20" height="20"></iconify-icon>
                                    </a>
                                    <button
                                        class="btn btn-light-danger btn-rounded btn-icon d-inline-flex align-items-center"
                                        wire:click="$js.confirmDelete({{ $server->id }})">
                                        <iconify-icon icon="mingcute:delete-2-line" width="20"
                                            height="20"></iconify-icon>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No Servers found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{ $servers->links('components.pagination', data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
@script
    <script>
        $js('confirmDelete', (id) => {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.deleteServer(id);
                }
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
