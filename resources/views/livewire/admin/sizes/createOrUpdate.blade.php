<div class="main-title">
    <div class="small">
        @lang('admin.Home')
    </div>
    <div class="large">
        {{$obj?'تعديل' :'اضافة'}} المقاس
    </div>
</div>
<div class="row g-3">
    <div class="col-12 col-md-4 col-lg-3">
        <div class="inp-holder">
            <label class="special-input">
                <span>الاسم </span>
                <input type="text" wire:model="name" class="form-control">
            </label>
        </div>
    </div>

    <div class="col-12 col-md-4 col-lg-3">
        <div class="inp-holder">
            <label class="special-input"> الحالة </label>
            <select wire:model="active" class="form-select">
                <option value="1">مفعل</option>
                <option value="0">غير مفعل</option>
            </select>
        </div>
    </div>


    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="btn-holder mt-2">
            <button wire:click="submit" class="main-btn">{{__('admin.Save')}}</button>
        </div>
    </div>
</div>

