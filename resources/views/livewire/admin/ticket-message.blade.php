<div>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-light d-flex align-items-center justify-content-between">
                <h5 class="mb-0 font-weight-bold">Ticket: {{ \Illuminate\Support\Str::limit($ticket->subject, 50) }}</h5>
                <div class="d-flex align-items-center gap-2">
                    @if ($ticket->status == 'open')
                        <span class="badge bg-success">Open</span>
                    @elseif ($ticket->status == 'closed')
                        <span class="badge bg-danger">Closed</span>
                    @else
                        <span class="badge bg-warning">Pending</span>
                    @endif

                    @if ($ticket->status !== 'closed')
                        <button wire:click="$js.updateStatus({{ $ticket->id }}, 'closed')" class="btn btn-sm btn-outline-danger">Close</button>
                    @endif
                    @if ($ticket->status !== 'open')
                        <button wire:click="$js.updateStatus({{ $ticket->id }}, 'open')" class="btn btn-sm btn-outline-success">Open</button>
                    @endif
                    @if ($ticket->status !== 'pending')
                        <button wire:click="$js.updateStatus({{ $ticket->id }}, 'pending')" class="btn btn-sm btn-outline-warning">Pending</button>
                    @endif
                </div>
            </div>

            <div class="card-body" style="height: 500px; overflow-y: auto;">
                {{-- Chat messages loop --}}
                @foreach ($ticket->messages as $msg)
                    <div class="mb-3">
                        <small class="text-muted">{{ $msg->created_at->diffForHumans() }}</small>
                        <div class="d-flex align-items-center">
                            <strong>{{ $msg->is_admin ? 'Admin' : $ticket->user->name }}</strong>
                        </div>                        
                        <p id="chat-message-{{ $msg->id }}">{{ $msg->message }}</p>
                        @if ($msg->getMedia('attachments')->count())
                            <div class="mt-2">
                                @foreach ($msg->getMedia('attachments') as $media)
                                    <img src="{{ $media->getUrl() }}" alt="attachment" style="max-height: 100px;" class="mr-2 rounded shadow-sm">
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="card-footer">
                @if ($uploadedImagesCount > 0)
                    <div class="text-info small mb-2">
                        {{ $uploadedImagesCount }} image{{ $uploadedImagesCount > 1 ? 's' : '' }} attached
                        <a href="#" wire:click="resetForm" class="text-danger ml-2">Clear</a>
                    </div>
                @endif

                <div class="mb-2">
                    {{-- FilePond uploader --}}
                    <div wire:ignore>
                        <x-filepond::upload
                            wire:model="attachments"
                            multiple
                            allow-image-preview
                            image-preview-max-height="150"
                            allow-file-type-validation
                            accepted-file-types="['image/png','image/jpeg','image/jpg']"
                            allow-file-size-validation
                            max-file-size="20mb"
                        />
                    </div>
                </div>

                <div class="input-group">
                    <textarea class="form-control" placeholder="Type your reply..." wire:model.defer="message"
                        @keydown.enter="!$event.shiftKey && ($event.preventDefault(), $wire.sendReply())"></textarea>
                    <div class="input-group-append">
                        <button class="btn btn-primary" wire:click="sendReply">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    @filepondScripts
    <script>
        $js('updateStatus', (id, status) => {
            Swal.fire({
                title: `Change status to ${status}?`,
                text: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(result => {
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
@endpush
