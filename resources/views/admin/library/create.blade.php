@extends('admin.layouts.admin')
@section('content')
<div class="main-side">
    <div class="main-title">
        <div class="small">
            {{__('admin.Home')}}
        </div>
        <div class="large">
            اضافة تنبيه
        </div>
    </div>
    <div class="row">

        <!-- <div class="col-12 col-md-4 col-lg-3">
            <div class="form-group">
                <label for="id">{{__('admin.Select Members')}}</label>
                <select wire:model.live="selected" class="form-control users_id" name="id" id="id">
                    <option value="">{{__('admin.Choose')}}</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="form-group">
                <label for="id">{{__('admin.Select Member')}}</label>
                <select wire:model="user_id" class="form-control users_id">
                    <option value="">{{__('admin.Choose')}}</option>
                    <option value=""></option>
                </select>
            </div>
        </div> -->

        <div class="col-12 col-md-12 m-0">
            <hr class="border-0 m-0">
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label class="mb-1" for="notification">الرسالة </label>
                <textarea rows="5" id="mytextarea" class="form-control"></textarea>
            </div>
        </div>
        <div class="col-12">
            <button wire:click="submit" class="main-btn mt-3 px-4">{{__('admin.Send')}}</button>
        </div>
    </div>
</div>
@endsection
