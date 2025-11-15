@extends('front.layouts.front')
@section('title', 'الاشعارات')

@section('content')
    <section class="main-section notice">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="main-heading">{{ __('Notifications') }}</h4>

                @if($notifications->total() > 0)
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAllModal">
                        <i class="fas fa-trash"></i>
                        {{ __('Delete all notifications') }}
                    </button>
                @endif
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="bg-white p-3 rounded-2 shadow">
                @forelse($notificationGroups as $date => $notificationsForDate)
                    <div class="box-notify-new">
                        <div class="date">{{ $date }}</div>
                        @foreach($notificationsForDate as $notification)
                            <div class="message-holder d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="fa-regular fa-bell me-2"></i>
                                    <div class="msg">
                                        <div class="text">{!! $notification->title !!}</div>
                                        <div class="time">{{ $notification->created_at->translatedFormat('h:i A') }}</div>
                                    </div>
                                </div>

                                <button class="btn btn-sm btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteSingleModal"
                                        data-id="{{ $notification->id }}">
                                    {{ __('Delete') }}
                                </button>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <p class="text-center">{{ __('There are no notifications') }}</p>
                @endforelse

                <div class="mt-4 d-flex justify-content-center">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </section>

    {{-- Modal حذف الكل --}}
    <div class="modal fade" id="deleteAllModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('notifications.destroyAll') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAllModalLabel">{{ __('Confirm deletion of all notifications') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        {{ __('Are you sure you want to delete') }} <strong>{{ __('All notifications?') }}</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">{{ __('cancel') }}</button>
                        <button type="submit" class="btn btn-danger btn-sm px-3">{{ __('Yes, delete all') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal حذف فردي --}}
    <div class="modal fade" id="deleteSingleModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="deleteSingleForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteSingleModalLabel">{{ __('Confirm deletion of notice') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        {{ __('Are you sure you want to delete this notification?') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">{{ __('cancel') }}</button>
                        <button type="submit" class="btn btn-danger btn-sm px-3">{{ __('Yes, delete it') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- سكربت لتعديل action في مودال الحذف الفردي --}}
    <script>
        const deleteSingleModal = document.getElementById('deleteSingleModal');
        deleteSingleModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const notificationId = button.getAttribute('data-id');
            const form = document.getElementById('deleteSingleForm');
            form.action = `/notifications/${notificationId}`;
        });
    </script>
@endsection
