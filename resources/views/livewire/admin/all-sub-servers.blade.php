@section('title', 'Sub Servers')
<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Sub Servers</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h4 class="card-title">Sub Servers</h4>
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
                </div>
                <div class="d-flex justify-content-end mb-2">
                    <a href="{{ route('admin.create.sub-server', $server->id) }}"
                        class="btn btn-light waves-effect">Create Server</a>
                </div>
            </div>
            <table id="tech-companies-1" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Linked VPS Server</th>
                        <th>VPS Server Username</th>
                        <th>VPS Server IP Address</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subServers as $subServer)
                        <tr>
                            <td>{{ $subServer->id }}</td>
                            <td>{{ $subServer->name }}</td>
                            <td>{{ $subServer->vpsServer->name ?? 'N/A' }}</td>
                            <td>{{ $subServer->vpsServer->username }}</td>
                            <td>{{ $subServer->vpsServer->ip_address }}</td>
                            <td>
                                <span
                                    class="badge {{ $subServer->isActive() ? 'badge-light-success' : 'badge-light-danger' }}">
                                    {{ $subServer->status === 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $subServer->created_at->toFormattedDateString() }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('admin.edit.sub-server', $subServer->id) }}"
                                        class="btn btn-light-success btn-rounded btn-icon me-1 d-inline-flex align-items-center">
                                        <iconify-icon icon="lucide:edit" width="20" height="20"></iconify-icon>
                                    </a>
                                    <button
                                        class="btn btn-light-danger btn-rounded btn-icon d-inline-flex align-items-center"
                                        wire:click="$js.confirmDelete({{ $subServer->id }})">
                                        <iconify-icon icon="mingcute:delete-2-line" width="20"
                                            height="20"></iconify-icon>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No Sub Servers found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{ $subServers->links('components.pagination', data: ['scrollTo' => false]) }}
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
                    $wire.deleteSubServer(id);
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
