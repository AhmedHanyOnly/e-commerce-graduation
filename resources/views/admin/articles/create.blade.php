@extends('admin.layouts.admin')
@section('title', 'المقال')
@section('content')
<div class="main-side">
    <div class="main-title">
        <div class="small">
          @lang("Home")
        </div>
        <div class="large">
          @lang("Add article")
        </div>
    </div>
    <form action="{{ route('admin.articles.store') }}" method="post" enctype="multipart/form-data">
        <div class="row g-3">
            @csrf
            @include('admin.articles.form')
        </div>
    </form>

</div>
@endsection
