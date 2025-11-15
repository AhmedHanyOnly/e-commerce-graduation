<div class="modal fade" id="delete{{ $ticket->id }}"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Delete ticket') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('tickets.destroy',$ticket->id) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    {{ __('Are you sure you want to delete the ticket?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">{{ __('cancel') }}</button>
                    <button type="submit" class="btn btn-success btn-sm px-3">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
