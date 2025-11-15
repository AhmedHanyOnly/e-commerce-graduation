@extends('admin.layouts.admin')
@section('content')
    <div class="main-side">
        <x-message-admin/>
        <div class="main-title">
            <div class="small">
                @lang("Home")
            </div>
            <div class="large">
                التذاكر
            </div>
        </div>
        <div class="btn-holder d-flex align-items-center justify-content-start gap-1 mb-2">
            <button type="button" class="main-btn" data-bs-toggle="modal" data-bs-target="#create">
                @lang("Add")
                <i class="fa-solid fa-plus"></i>
            </button>
            @include('admin.ticket.create-modal')
            <a href="{{route('admin.tickets.index')}}" type="button" class="main-btn btn-main-color">الكل: {{ App\Models\Ticket::count() }}</a>
            <a href="{{route('admin.tickets.index',['status' => 'open'])}}" type="button" class="main-btn btn-blue">مفتوحة: {{ App\Models\Ticket::where('status','open')->count() }}</a>
            <a href="{{route('admin.tickets.index',['status' => 'closed'])}}" type="button" class="main-btn btn-orange">مغلقة: {{ App\Models\Ticket::where('status','closed')->count() }}</a>
            {{-- <a type="button" class="main-btn btn-purple">تم الرد: {{ App\Models\Ticket::has('comments')->count() }}</a> --}}
            <a href="{{ route('admin.tickets.index', ['replied' => 'true']) }}" type="button" class="main-btn btn-purple">
                تم الرد: {{ App\Models\Ticket::has('comments')->count() }}
            </a>
            {{-- <a href="{{ route('admin.tickets.index', ['replied' => 'true']) }}" type="button" class="main-btn btn-purple">تم الرد: {{ App\Models\Comment::distinct('ticket_id')->count('ticket_id') }}</a> --}}

        </div>
        <div class="table-responsive">
            <table class="main-table mb-2">
                <thead>
                <tr>
                    <th>#</th>
                    <th>العميل</th>
                    <th>@lang("Address")</th>
                    <th>@lang("Category")</th>
                    <th>المحتوى</th>
                    <th>@lang("Status")</th>
                    <th>التعليقات</th>
                    <th>@lang("Actions")</th>
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
                            الطلبات
                            @elseif($ticket->type == 'activate_mempership')
                            تفعيل العضوية
                            @else
                            آخرى
                            @endif
                        </td>
                        <td>
                            {{ Str::limit($ticket->description, 50, $end = '....') }}
                        </td>

                        <td>
                            @if ($ticket->status == 'open')
                                <span class="badge bg-warning">مفتوحة</span>
                            @elseif($ticket->status == 'finished')
                                <span class="badge bg-success">تم الرد</span>
                            @else
                                <span class="badge bg-danger">مغلقة</span>
                            @endif
                        </td>
                        <td>

                            <a class="btn btn-secondary btn-sm" href="{{ route('admin.tickets.show', $ticket->id) }}"> التعليقات
                                ({{ $ticket->comments->count() }})
                            </a>


                        </td>

                        <td class="d-flex gap-2">
                            <button type="button" class="btn btn-info btn-sm text-white mx-1" data-bs-toggle="modal" data-bs-target="#edit{{ $ticket->id }}">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete{{ $ticket->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                            <button type="button" class="btn btn-primary btn-sm text-white mx-1" data-bs-toggle="modal" data-bs-target="#add_comment">
                                أضف تعليق
                            </button>


                            @include('admin.ticket.edit-modal', ['ticket' => $ticket])
                            @include('admin.ticket.delete-modal', ['ticket' => $ticket])
                            @include('admin.ticket.add_comment', ['ticket' => $ticket])
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            {{ $tickets->links() }}
        </div>
    </div>
@endsection
