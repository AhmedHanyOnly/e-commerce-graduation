@extends('admin.layouts.admin')
@section('title', 'المقال')
@section('content')
<div class="main-side">
    <div class="main-title">
        <div class="small">
            @lang("Home")

        </div>
        <div class="large">
تعديل مقال        </div>
    </div>
    <form action="{{ route('admin.articles.update',$articles->id) }}" method="post" enctype="multipart/form-data">
        <div class="row g-3">
            @csrf
            @method('PUT')
            @include('admin.articles.form')
        </div>
    </form>

</div>
@endsection
