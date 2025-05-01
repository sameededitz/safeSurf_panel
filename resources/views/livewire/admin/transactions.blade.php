

<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Plans</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Transactions</h4>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
            <div class="d-flex flex-row" >
                <div style=" margin-right: 10px;">
                    <select class="form-control" name="perpage" wire:model.live="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div >
                    <select class="form-control" wire:model.live="priceFilter">
                        <option value="" selected>Max Price</option>
                        <option value="10">Under $10</option>
                        <option value="20">Under $20</option>
                        <option value="50">Under $50</option>
                        <option value="100">Under $100</option>
                    </select>
                </div>
                <div style="margin-left: 10px;">
                    <select class="form-control " wire:model.live="durationUnitFilter">
                        <option value="" selected>Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="expired">expired</option>
                        <option value="cancelled">Cancelled</option>
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
                        <th data-priority="1">Name</th>
                        <th data-priority="3">Plan</th>
                        <th data-priority="4">Paid Amount</th>
                        <th data-priority="5">Start Date</th>
                        <th data-priority="6">End Date</th>
                        <th data-priority="7">Status</th>
                        <th data-priority="8">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->id }}</td>
                                        <td>
                                            {{ Str::title($purchase->user->name) ?? 'N/A' }}
                                        </td>
                                        <td>{{ $purchase->plan->name ?? 'N/A' }}</td>
                                        <td>${{ number_format($purchase->amount_paid, 2) }}</td>
                                        <td>{{ $purchase->start_date->toFormattedDateString() }}</td>
                                        <td>{{ optional($purchase->end_date)->toFormattedDateString() ?? 'N/A' }}</td>
                                        <td>
                                            <span
                                                class="badge badge-light-{{ $purchase->status == 'active' ? 'success' : ($purchase->status == 'expired' ? 'danger' : 'warning') }}">
                                                {{ ucfirst($purchase->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                @if ($purchase->status != 'active')
                                                    @if (
                                                        ($purchase->status == 'expired' || $purchase->status == 'cancelled') &&
                                                            \Carbon\Carbon::parse($purchase->end_date)->isFuture())
                                                        <button type="button"
                                                            wire:click="$js.updateStatus({{ $purchase->id }}, 'active')"
                                                            @disabled($purchase->status == 'active')
                                                            class="btn btn-outline-success d-flex align-items-center justify-content-center">
                                                            <iconify-icon icon="material-symbols:check-circle"
                                                                width="20" height="20"></iconify-icon>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button type="button"
                                                        wire:click="$js.updateStatus({{ $purchase->id }}, 'expired')"
                                                        @disabled($purchase->status == 'expired')
                                                        class="btn btn-outline-warning d-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="mdi:clock-alert" width="20"
                                                            height="20"></iconify-icon>
                                                    </button>
                                                    <button type="button"
                                                        wire:click="$js.updateStatus({{ $purchase->id }}, 'cancelled')"
                                                        @disabled($purchase->status == 'cancelled')
                                                        class="btn btn-outline-danger d-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="mdi:close-circle" width="20"
                                                            height="20"></iconify-icon>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                        
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{-- {{ $plans->links('components.pagination', data: ['scrollTo' => false]) }} --}}
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
                    $wire.deletePlan(id);
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