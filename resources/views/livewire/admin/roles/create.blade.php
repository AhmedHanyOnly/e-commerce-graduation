<form wire:submit.prevent="submit()">
    <div class="row w-100 mx-0 p-3 mb-5 mt-5  bg-white">
    <button class="main-btn btn-main-color" wire:click='$set("screen","index")'>@lang('admin.Show all roles')</button>

        <div class="col-md-12 mb-3">
            @if ($role_id == false)
                <h3 class="mb-3">@lang('admin.Add a group')</h3>
            @else
                <h3 class="mb-3">@lang('admin.Edit group')</h3>
            @endif
        </div>
        <div class="col-md-12">
            <div class="form-group ">
                <label for="" class="mb-2">@lang('admin.Group name')</label>
                <div class="d-flex">
                    <input type="text" class="form-control" wire:model.defer="name" wire:keydown.enter="submit()">
                </div>
                @error('name')
                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                @enderror
            </div>
        </div>
        @foreach ($permission as $value)
            <div class="col-xs-6 col-md-4 col-lg-3">

                <label style="font-size: 16px;">
                    <input type="checkbox" wire:model.defer='permission_request'
                        {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}  value="{{ $value->id }}">
                    {{ __($value->name) }}</label>
            </div>
        @endforeach

        <div class="col-md-12 mb-3">
            <button class="btn btn-primary">@lang("Save")</button>
        </div>

    </div>
</form>
