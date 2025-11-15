<div class="main-side">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="main-title">
            <div class="small">
                @lang("Home")
            </div>
            <div class="large">
            صور
            </div>
        </div>
    </div>
    <x-admin-alert></x-admin-alert>
    <div class="row g-3">
        <div class="col-12 col-md-4 col-lg-3">
            <label for="">المجموعات</label>
            <select wire:model.defer="program_id" class="form-control">
                <option value="">اختر المجموعة</option>
                @foreach ($programs as $program)
                <option value="{{ $program->id }}">{{ $program->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <label for="">نوع الرسالة</label>
            <select wire:model.live="msg_type" class="form-control">
                <option value="">اختر نوع الرسالة</option>
                <option value="1">نصية</option>
                <option value="2">@lang("Photo")</option>
            </select>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <label for="">الرسائل</label>
            <select wire:model.defer="message_id" class="form-control">
                <option value="">اختر الرسالة</option>
                @foreach ($msgs as $m)
                <option value="{{ $m->id }}">{{ $m->content }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <label for="">العدد</label>
            <input type="number" min="0" oninput="validateInput(this)" wire:model.defer="count" class="form-control">
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <label for=""> ارسل سابقا</label>
            <input type="checkbox" wire:model.defer="prev" >
        </div>
        <div class="col-12">
            <div class="btn-holder">
                <button type="button" class="main-btn" wire:click='submit'>@lang("Save")</button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        function validateInput(input) {
            if (input.value < 0 || input.value === "-") {
                input.value = '';
            }
        }
    </script>
@endpush
