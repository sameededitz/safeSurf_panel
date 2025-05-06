

    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.feedback') }}">Feedbacks</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Feedbacks</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        
        
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                        <h4 class="card-title m-10">Feedbacks</h4>
                        {{-- <a href="{{ route('admin.create.notifications') }}" class="btn btn-light waves-effect float-right">Create Notification</a> --}}
                        
                </div>
            </div>
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
                    </div>
                    <div style="margin-left: 10px;">
                    </div>
                </div>  
                <div class="d-flex justify-content-end mb-2">
                    <input type="text" class="form-control" placeholder="Search" wire:model.live.500ms="search">
                </div>
            </div>
                <table id="tech-companies-1" class="table  table-striped">
                    <thead>
                        <tr>
                            <th data-priority="1">#</th>
                            <th data-priority="1">Subject</th>
                            <th data-priority="3">Email</th>
                            <th data-priority="4">Sent At</th>
                            <th data-priority="5">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($feedbacks as $feedback)
                        <tr>
                            <td>{{ $feedback->id }}</td>
                            <td>{{ $feedback->subject }}</td>
                            <td>${{ $feedback->email  }}</td>
                            <td>{{ $feedback->created_at->toFormattedDateString() }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <button type="button" wire:click="viewFeedback({{ $feedback->id }})"
                                        data-toggle="modal" data-target="#feedbackModel"
                                        class="btn btn-outline-primary d-flex align-items-center justify-content-center">
                                        <iconify-icon icon="material-symbols:visibility" width="20"
                                            height="20"></iconify-icon>
                                    </button>
                                    <button class="btn btn-light-danger btn-rounded btn-icon d-inline-flex align-items-center"
                                    wire:click="$js.confirmDelete({{ $feedback->id }})">
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
                {{ $feedbacks->links('components.pagination', data: ['scrollTo' => false]) }}
            </div>
        </div>
        




        <div class="modal fade" id="feedbackModel" wire:ignore.self tabindex="-1" aria-labelledby="feedbackModel"
              aria-hidden="true">
           <div class="modal-dialog modal-lg">
              <div class="modal-content">
                 <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">
                        View Feedback
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" wire:click="closeModel"
                                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>      
                 </div>
                 <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                           <h6 class="font-weight-bold">Email</h6>
                           <p class="text-muted">{{ $email }}</p>
                        </div>
                        <div class="col-12 mb-3">
                           <h6 class="font-weight-bold">Subject</h6>
                           <p class="text-muted">{{ $subject }}</p>
                        </div>
                        <div class="col-12">
                           <h6 class="font-weight-bold">Message</h6>
                           <p class="text-muted">{{ $message }}</p>
                        </div>
                    </div>
                 </div>
                 <div class="modal-footer">
                    <button type="button" class="btn btn-secondary d-flex align-items-center justify-content-center"
                        wire:click="closeModel" data-dismiss="modal">Close</button>
                 </div>
              </div>
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
                        $wire.deleteNotification(id);
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