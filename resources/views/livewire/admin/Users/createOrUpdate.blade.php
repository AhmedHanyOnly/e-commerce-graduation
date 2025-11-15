<div class="d-flex align-items-center justify-content-between gap-3 mb-3">
    <button class="main-btn btn-main-color" wire:click='$set("screen","index")'>@lang("View all admins")</button>
</div>
<div class="row g-3">
    <div class="col-xs-12 col-sm-4 mb-3">
        <label for="">أسم المشرف <span class="text-red">*</span></label>
        <input class=" form-control " type="text" placeholder="" wire:model.defer="name" />
    </div>

    <div class="col-xs-12 col-sm-4 mb-3">
        <label for=""> البريد الألكتروني:</label>
        <input class=" form-control " type="email" placeholder="  " wire:model.defer="email" />
    </div>

    <div class="col-xs-12 col-sm-4 mb-3">
        <label for=""> المجموعة:</label>

        <select class=" form-select " wire:model.defer="role_id" id="">
            <option value="">اختر المجموعة</option>
            @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-xs-12 col-sm-4 mb-3">
        <label for=""> كلمة المرور:</label>
        <input class=" form-control " type="password" placeholder="" wire:model.defer="password" />
    </div>
    <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-sm btn-success" wire:click="submit">@lang("Save") <i class="fas fa-plus"></i></button>

    </div>
</div>
