@extends('admin.layouts.admin')
@section('title','تعديل الطلب')
@section('content')
    @livewire('admin.orders.form',['id'=>$id])

@endsection
