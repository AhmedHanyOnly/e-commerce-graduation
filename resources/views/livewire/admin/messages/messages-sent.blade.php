<div class="main-side">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="main-title">
            <div class="small">
                @lang("Home")
            </div>
            <div class="large">
                الرسائل المرسلة
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <a href="{{ route('admin.SendMessage') }}" wire:navigate class="main-btn">@lang("Add") <i class="fas fa-plus"></i></a>
        <table class="main-table">
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>@lang("Content")</th>
                    <th>المرفق</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($msgs as $msg)
                <tr>
                    <td>
                        {{ $loop->index +1 }}
                    </td>
                    <td>
                        {{ $msg->message }}
                    </td>
                    <td>
                        @if($msg->image)
                        <a target="_blank" href="{{ display_file($msg->image) }}" class="btn-light-purple"><i
                                class="fas fa-eye"></i> معاينة المرفق </a>
                        @else
                        لا يوجد
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">لا يوجد رسائل</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>