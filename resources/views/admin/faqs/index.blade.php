@extends('admin.layouts.admin')
@section('title', 'الاسئلة الشائعة')

@section('content')
<div class="main-side">

    <div class="main-title">
        <div class="small">
            @lang('admin.Dashboard')
        </div>
        <div class="large">
            @lang('admin.FAQs')
        </div>
    </div>

    <div class="d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
        <a class="main-btn" href="{{ route('admin.faqs.create') }}">
            @lang('admin.Add') <i class="fas fa-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table id="datatable" class="table table-bordered table-hover" style="text-align:center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('admin.Question')</th>
                    <th>@lang('admin.Answer')</th>
                    <th>@lang('admin.Actions')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($faqs as $first)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $first->question }}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                data-bs-target="#content{{ $first->id }}">
                                @lang('admin.Answer')
                            </button>
                        </td>
                        <td>
                            <a href="{{ route('admin.faqs.edit', [$first->id]) }}" class="btn btn-info btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>

                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#delete{{ $first->id }}">
                                <i class="fa fa-trash"></i>
                            </button>

                            @include('admin.faqs.content-modal', ['first' => $first])
                            @include('admin.faqs.content_en-modal', ['first' => $first])
                            @include('admin.faqs.delete-modal', ['first' => $first])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $faqs->links() }}
    </div>
</div>

@endsection
