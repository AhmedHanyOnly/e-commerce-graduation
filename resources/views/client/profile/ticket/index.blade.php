<div class="col-content col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">

    <div class="btn-holder flex-wrap  d-flex align-items-center justify-content-start gap-1 mb-2">
        <button type="button" class="main-btn px-3" data-bs-toggle="modal" data-bs-target="#create">
            {{ __('Add') }}
            <i class="fa-solid fa-plus"></i>
        </button>
        @include('client.profile.ticket.create-modal')
        <button wire:click="$set('ticket_status','')" type="button" class="btn btn-primary rounded-pill">{{ __('all') }}:
            {{ App\Models\Ticket::where('user_id', auth()->user()->id)->count() }}</button>
        <button wire:click="$set('ticket_status','open')" type="button" class="btn btn-warning rounded-pill">{{ __('open') }}:
            {{ App\Models\Ticket::where('status', 'open')->where('user_id', auth()->user()->id)->count() }}</button>
        <button wire:click="$set('ticket_status','closed')" type="button" class="btn btn-danger rounded-pill">{{ __('closed') }}:
            {{ App\Models\Ticket::where('status', 'closed')->where('user_id', auth()->user()->id)->count() }}</button>
        <button wire:click="$set('ticket_status','finished')" type="button" class="btn btn-success rounded-pill">{{ __('answered') }}:
            {{ App\Models\Ticket::where('status', 'finished')->where('user_id', auth()->user()->id)->count() }}</button>
    </div>
    <div class="table-responsive">
        <table class="main-table mb-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('client') }}</th>
                    <th>{{ __('Address') }}</th>
                    <th>{{ __("Category") }}</th>
                    <th>{{ __('content') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('read') }}</th>
                    <th>{{ __('comments') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        {{-- <td>{{ $ticket->user?->name }} - {{ __($ticket->user?->type) }} </td> --}}
                        <td>{{ $ticket->user?->name }} </td>

                        <td>{{ $ticket->title }}</td>
                        <td>
                            @if ($ticket->type == 'orders')
                                {{ __('Orders') }}
                            @elseif($ticket->type == 'activate_mempership')
                                {{ __('Activate membership') }}
                            @else
                                {{ __('another') }}
                            @endif
                        </td>
                        <td>
                            {{ Str::limit($ticket->description, 50, $end = '....') }}
                        </td>

                        <td>
                            @if ($ticket->status == 'open')
                                <span class="badge bg-warning">{{ __('open') }}</span>
                            @elseif($ticket->status == 'finished')
                                <span class="badge bg-success">{{ __('answered') }}</span>
                            @else
                                <span class="badge bg-danger">{{ __('closed') }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($ticket->is_read)
                                <span class="badge bg-success">{{ __('Been reading') }}</span>
                            @else
                                <span class="badge bg-warning">{{ __('Not read') }}</span>
                            @endif
                        </td>
                        <td>

                            <a class="btn btn-secondary btn-sm" href="{{ route('tickets.show', $ticket->id) }}">
                                {{ __('comments') }}
                                ({{ $ticket->comments->count() }})
                            </a>


                        </td>

                        <td>
                            <div class="d-flex gap-1">
                                @if ($ticket->status !== 'closed')
                                    <button type="button" class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#add_comment">
                                        {{ __('Add a comment') }}
                                    </button>
                                @endif
                                <button type="button" class="btn btn-info btn-sm text-white" data-bs-toggle="modal"
                                    data-bs-target="#edit{{ $ticket->id }}">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#delete{{ $ticket->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>

                            @include('client.profile.ticket.edit-modal', ['ticket' => $ticket])
                            @include('client.profile.ticket.delete-modal', ['ticket' => $ticket])
                            @include('client.profile.ticket.add_comment', ['ticket' => $ticket])
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{ $tickets->links() }}
    </div>
</div>
