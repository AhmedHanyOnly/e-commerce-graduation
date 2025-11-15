<div class="modal fade" id="create" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Add a new ticket') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('tickets.store') }}" method="POST">
                <div class="modal-body row g-3">
                    @csrf
                    {{-- <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="">العميل</label>
                            <select name="user_id" id="" class="form-control">
                                <option value="">اختر العميل</option>
                                @foreach (App\Models\User::whereIn('type', ['reporter', 'vendor', 'judger'])->get() as $reporter)
                                        <option value="{{ $reporter->id }}">{{ $reporter->name }}

                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

                    <input type="hidden" name="user_id" value="{{auth()->id()}}">
                        {{-- <input type="hidden" name="ticket_id" value="{{ $ticket->id }}"> --}}

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label for="">{{ __('type') }}</label>
                            <select name="type" id="" class="form-select">
                                <option value="">{{ __('Select type') }}</option>
                                <option value="orders">{{ __('Orders') }}</option>
                                <option value="activate_mempership">{{ __('Activate membership') }}</option>
                                <option value="other">{{ __('another') }}</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label for="">{{ __('Ticket address') }}</label>
                            <input type="text" name="title" id="" class="form-control">
                        </div>

                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">{{ __('description') }}</label>
                            <textarea name="description" class="form-control" rows="8"></textarea>
                        </div>
                    </div>
                    {{--                    <div class="col-12">--}}
                    {{--                        <div class="form-group">--}}
                    {{--                            <label for="">مرفق</label>--}}
                    {{--                            <input type="file" name="file" class="form-control">--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">{{ __('cancel') }}</button>
                    <button type="submit" class="btn btn-success btn-sm px-3">{{ __('Save') }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
