<div class="main-title">
    <div class="small">
      @lang("Home")
    </div>
    <div class="large">
       الاشعارات
    </div>
</div>
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group">
            <label for="id">اختر من الاعضاء</label>
            <select wire:model.live="selected" class="form-control users_id" name="id" id="id">
                <option value="">اختر</option>
                <option value="all_users">ارسال لكل الاعضاء</option>
                <!-- <option value="one_user">  مزود خدمة</option> -->
                <option value="two_user">عميل </option>
            </select>
        </div>
    </div>

    @if($selected == 'one_user')
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group">
            <label for="id">اختر عضو</label>
            <select wire:model="user_id" class="form-control users_id" name="id" id="id">
                <option value="">{{__('admin.Choose')}}</option>
                @foreach(\App\Models\User::where('type','vendor')->get() as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
@endif
    @if($selected == 'two_user' )
        <div class="col-12 col-md-4 col-lg-3">
            <div class="form-group">
                <label for="id">اختر عضو</label>
                <select wire:model="user_id" class="form-control users_id">
                    <option value="">{{__('admin.Choose')}}</option>
                    @foreach(\App\Models\User::clients()->get() as $client)
                        <option value="{{$client->id}}">{{$client->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif



    <div class="col-12 col-md-12 m-0">
        <hr class="border-0 m-0">
    </div>
<div class="col-12 col-md-4 col-lg-3 my-2">
    <div class="form-group">
        <label for="id">اختر رسالة</label>
        <select wire:model="library_id" class="form-control users_id">
            <option value="">{{__('admin.Choose')}}</option>
            @foreach(\App\Models\NotificationLibrary::get() as $library)
                <option value="{{$library->id}}">{!!$library->content!!}</option>
            @endforeach
        </select>
    </div>
</div>


    <div class="col-12">
        <button wire:click="submit" class="main-btn px-4">ارسال</button>
    </div>
