<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Users</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>


    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4 class="card-title m-10">Users</h4>
                <a href="{{ route('admin.create.user') }}" class="btn btn-light waves-effect float-right">Create
                    User</a>

            </div>
        </div>
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
                    <div>
                        <select class="form-control" wire:model.live="emailVerified">
                            <option value="">All</option>
                            <option value="1">Varified</option>
                            <option value="2">Not Varified</option>
                        </select>
                    </div>
                    <div class="dropdown mo-mb-2" style="margin-left: 10px;">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Date Filters
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start"
                            style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <div class="px-3 py-2">
                                <label for="registeredFrom" class="form-label">Registered From</label>
                                <input type="date" id="registeredFrom" class="form-control"
                                    wire:model.live="filters.registeredFrom">
                            </div>
                            <div class="px-3 py-2">
                                <label for="registeredTo" class="form-label">Registered To</label>
                                <input type="date" id="registeredTo" class="form-control"
                                    wire:model.live="filters.registeredTo">
                            </div>
                            <div class="px-3 py-2">
                                <label for="lastLoginFrom" class="form-label">Last Login From</label>
                                <input type="date" id="lastLoginFrom" class="form-control"
                                    wire:model.live="filters.lastLoginFrom">
                            </div>
                            <div class="px-3 py-2">
                                <label for="lastLoginTo" class="form-label">Last Login To</label>
                                <input type="date" id="lastLoginTo" class="form-control"
                                    wire:model.live="filters.lastLoginTo">
                            </div>
                            <div class="px-3 py-2">
                                <button class="btn btn-primary btn-block" wire:click="applyFilters">Apply
                                    Filters</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-2">
                    <input type="text" class="form-control" placeholder="Search..." wire:model.live.500ms="search">
                </div>
            </div>
            <table id="tech-companies-1" class="table  table-striped">
                <thead>
                    <tr>
                        <th data-priority="1">#</th>
                        <th data-priority="1">Name</th>
                        <th data-priority="3">Email</th>
                        <th data-priority="4">Last Login</th>
                        <th data-priority="5">Joined</th>
                        <th data-priority="6">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->last_login }}</td>
                            <td>{{ $user->last_login ? $user->last_login->diffForHumans() : 'N/A' }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('admin.user.manager', ['user' => $user->slug]) }}"
                                        class="btn btn-outline-info d-flex align-items-center justify-content-center">
                                        <Iconify-icon icon="ic:round-manage-accounts" width="20"
                                            height="20"></Iconify-icon></a>
                                    <a href="{{ route('admin.edit.user', $user->id) }}"
                                        class="btn btn-light-success btn-rounded btn-icon me-1 d-inline-flex align-items-center">
                                        <iconify-icon icon="lucide:edit" width="20" height="20"></iconify-icon>
                                    </a>
                                    <button
                                        class="btn btn-light-danger btn-rounded btn-icon d-inline-flex align-items-center"
                                        wire:click="$js.confirmDelete({{ $user->id }})">
                                        <iconify-icon icon="mingcute:delete-2-line" width="20"
                                            height="20"></iconify-icon>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{ $users->links('components.pagination', data: ['scrollTo' => false]) }}
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
                    $wire.deleteUser(id);
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
