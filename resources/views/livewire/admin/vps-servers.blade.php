<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Vps Servers</a></li>
                    </ol>
                </div>
                <h4 class="page-title">VPS Servers</h4>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <div class="d-flex flex-row">
                    <div style=" margin-right: 10px;">
                        <select class="form-control" name="perpage" wire:model.live="perPage">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div style="margin-left: 10px;">
                        <select class="form-control " wire:model.live="statusFilter">
                            <option value="" selected>Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-2">
                    <a href="{{ route('admin.create.vps-server') }}" class="btn btn-light waves-effect">Create VPS
                        Server</a>
                </div>
            </div>
            <table id="tech-companies-1" class="table  table-striped">
                <thead>
                    <tr>
                        <th data-priority="1">#</th>
                        <th data-priority="2">Name</th>
                        <th data-priority="3">IP Address</th>
                        <th data-priority="4">Username</th>
                        <th data-priority="5">Port</th>
                        <th data-priority="6">Domain</th>
                        <th data-priority="7">Status</th>
                        <th data-priority="8">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vpsServers as $server)
                        <tr>
                            <td>{{ $server->id }}</td>
                            <td>{{ $server->name }}</td>
                            <td>{{ $server->ip_address }}</td>
                            <td>{{ $server->username }}</td>
                            <td>{{ $server->port }}</td>
                            <td>{{ $server->domain }}</td>
                            <td>
                                <span class="badge {{ $server->status == 1 ? 'badge-success' : 'badge-danger' }}">
                                    {{ $server->status == 1 ? 'Active' : 'Inactive' }}</span>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('admin.vps-server-manager', $server->id) }}"
                                        class="btn btn-light-info btn-rounded btn-icon me-1 d-inline-flex align-items-center">
                                        <Iconify-icon icon="famicons:stats-chart-outline" width="20"
                                            height="20"></Iconify-icon>
                                    </a>
                                    <a href="{{ route('admin.edit.vps-server', $server->id) }}"
                                        class="btn btn-light-success btn-rounded btn-icon me-1 d-inline-flex align-items-center">
                                        <Iconify-icon icon="lucide:edit" width="20" height="20"></Iconify-icon>
                                    </a>
                                    <button
                                        class="btn btn-light-danger btn-rounded btn-icon d-inline-flex align-items-center"
                                        wire:click="$js.confirmDelete({{ $server->id }})">
                                        <Iconify-icon icon="mingcute:delete-2-line" width="20"
                                            height="20"></Iconify-icon>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No VPS servers found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{ $vpsServers->links('components.pagination', data: ['scrollTo' => false]) }}
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
                    $wire.deleteVpsServer(id);
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
