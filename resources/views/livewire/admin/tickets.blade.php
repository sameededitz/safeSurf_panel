<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Tickets</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Tickets</h4>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>


    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Tickets</h4>
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
                        <select class="form-control" wire:model.live="status">
                            <option value="" selected>All</option>
                            <option value="open">Open</option>
                            <option value="closed">Closed</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-2">
                    {{-- <a href="{{ route('admin.create.plan') }}" class="btn btn-light waves-effect">Create Plan</a> --}}
                </div>
            </div>
            <table id="tech-companies-1" class="table  table-striped">
                <thead>
                    <tr>
                        <th data-priority="1">#</th>
                        <th data-priority="1">User</th>
                        <th data-priority="3">Subject</th>
                        <th data-priority="1">Status</th>
                        <th data-priority="1">Priority</th>
                        <th data-priority="1">Department</th>
                        <th data-priority="3">Created</th>
                        <th data-priority="3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->user->name }}</td>
                            <td>
                                <a href="{{ route('admin.tickets.details', $ticket->id) }}"
                                    class="text-primary">{{ $ticket->subject }}</a>
                            </td>
                            <td>
                                @if ($ticket->status == 'open')
                                    <span class="badge bg-success">Open</span>
                                @elseif ($ticket->status == 'closed')
                                    <span class="badge bg-danger">Closed</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                            <td>
                                @if ($ticket->priority == 'high')
                                    <span class="badge bg-danger">High</span>
                                @elseif ($ticket->priority == 'medium')
                                    <span class="badge bg-warning">Medium</span>
                                @else
                                    <span class="badge bg-success">Low</span>
                                @endif
                            </td>
                            <td>
                                @if ($ticket->department)
                                    {{ Str::title($ticket->department) }}
                                @else
                                    <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>
                            <td>{{ $ticket->created_at->toFormattedDateString() }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if ($ticket->status !== 'closed')
                                        <button type="button"
                                            wire:click="$js.updateStatus({{ $ticket->id }}, 'closed')"
                                            class="btn btn-outline-danger d-flex align-items-center justify-content-center">
                                            <Iconify-icon icon="material-symbols:close-rounded" width="20"
                                                height="20"></Iconify-icon>
                                        </button>
                                    @endif
                                    @if ($ticket->status !== 'open')
                                        <button type="button"
                                            wire:click="$js.updateStatus({{ $ticket->id }}, 'open')"
                                            class="btn btn-outline-success d-flex align-items-center justify-content-center">
                                            <Iconify-icon icon="material-symbols:check-circle-outline" width="20"
                                                height="20"></Iconify-icon>
                                        </button>
                                    @endif
                                    @if ($ticket->status !== 'pending')
                                        <button type="button"
                                            wire:click="$js.updateStatus({{ $ticket->id }}, 'pending')"
                                            class="btn btn-outline-warning d-flex align-items-center justify-content-center">
                                            <Iconify-icon icon="material-symbols:hourglass-top" width="20"
                                                height="20"></Iconify-icon>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No Tickets found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{ $tickets->links('components.pagination', data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
@script
    <script>
        $js('updateStatus', (id, status) => {
            let actionText = status === 'open' ? 'Reopen' : (status === 'pending' ? 'mark as pending' : 'close');
            let actionBtnText = status === 'open' ? 'Yes, Reopen it!' : (status === 'pending' ?
                'Yes, Mark as Pending!' : 'Yes, Close it!');

            Swal.fire({
                title: `Are you sure you want to ${actionText} this Ticket?`,
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: actionBtnText
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.updateStatus(id, status);
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
