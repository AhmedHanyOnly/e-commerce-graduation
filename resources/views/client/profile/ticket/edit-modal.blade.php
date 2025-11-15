<div class="modal fade" id="edit{{ $ticket->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit a ticket') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
                <div class="modal-body row g-3">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="col-12 col-md-6">
                        <div class="form-group text-start">
                            <label for="">{{ __('type') }}</label>
                            <select name="type" id="" class="form-select">
                                <option value="">{{ __('Select type') }}</option>
                                <option value="orders" {{ $ticket->type == 'orders' ? 'selected' : '' }}>{{ __('Orders') }}</option>
                                <option value="activate_mempership" {{ $ticket->type == 'activate_mempership' ? 'selected' : '' }}>{{ __('Activate membership') }}</option>
                                <option value="other" {{ $ticket->type == 'other' ? 'selected' : '' }}>{{ __('another') }}</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group text-start">
                            <label for="">{{ __('Ticket address') }}</label>
                            <input type="text" name="title" id="" value="{{ $ticket->title }}"
                                class="form-control">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group text-start">
                            <label for="">{{ __('description') }}</label>
                            <textarea name="description" class="form-control" rows="8">{{ $ticket->description }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">{{ __('cancel') }}</button>
                    <button type="submit" class="btn btn-success btn-sm px-3">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
