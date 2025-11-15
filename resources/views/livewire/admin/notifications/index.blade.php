<div class="main-side">
    <x-message-admin />
    @if($screen=='index')
    <div class="main-title">
        <div class="small">
            @lang('admin.Home')
        </div>
        <div class="large">
            @lang('admin.Notifications')
        </div>
    </div>
    <div class="btn-holder d-flex align-items-center justify-content-between gap-1 flex-wrap mb-2">
        <div class="btn-holder d-flex align-items-center gap-1">
            <a wire:click="$set('screen','create')" class="main-btn">@lang('admin.Add')</a>
            @if(count($selectedNotifications) > 0)

            <button class="btn btn-danger" wire:click="deleteSelected">حذف المحدد</button>
            @endif
        </div>
        <div class="btn-holder">
            @if(\App\Models\Notification::count() > 0)
            <button class="btn btn-danger" wire:click="deleteAll">حذف الكل</button>
            @endif
        </div>
    </div>
    <div class="table-responsive">
        <table class="main-table mb-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('admin.Name')</th>
                    <th>@lang('admin.Notification')</th>
                    <th>@lang('Reading')</th>
                    <th><input type="checkbox" wire:model.live="SelectAll"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($notifications as $notification)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$notification->user?->name}}</td>
                    <td>{{$notification->created_at?->format('Y-m-d')}}</td>
                    <td>{{!$notification->seen_at ? __('لم تتم القراءة بعد') :__('تمت القراءة')}}</td>
                    <td><input type="checkbox" value="{{$notification->id}}" wire:model.live="selectedNotifications"></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">@lang('admin.Nothing')</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{$notifications->links()}}
    </div>
    @else
    @include('livewire.admin.notifications.create')
    @endif
</div>
