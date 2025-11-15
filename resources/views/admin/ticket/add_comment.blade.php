<div class="modal fade" id="add_comment" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Add a comment') }} - {{ $ticket->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.tickets.storeComment') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="user_id" value="1">
                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                    <div class="form-group mb-3">
                        <label for="">{{ __('comment') }}</label>
                        <textarea name="comment" class="form-control" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('attached') }}</label>
                        <input type="file" name="file" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm px-3"
                        data-bs-dismiss="modal">{{ __('cancel') }}</button>
                    <button type="submit" class="btn btn-success btn-sm px-3">{{ __('Save') }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
