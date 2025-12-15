@extends('admin.layout.index')

@section('title', 'Tạo Công việc mới')
@section('page-title', 'Tạo Job')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Tạo Bài đăng Công việc Mới</h1>

<div class="card shadow border-0 rounded-4">
    <div class="card-body p-5">
        <form method="POST" action="{{ route('admin.jobs.store') }}">
            @csrf

            <div class="mb-4">
                <label for="title" class="form-label font-weight-bold">Tiêu đề Công việc</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>
            
            <div class="mb-4">
                <label for="employer_id" class="form-label font-weight-bold">ID Công ty</label>
                {{-- Lưu ý: Thực tế nên dùng <select> với danh sách công ty --}}
                <input type="number" class="form-control" id="employer_id" name="employer_id" value="{{ old('employer_id') }}" required>
            </div>

            <div class="mb-4">
                <label for="description" class="form-label font-weight-bold">Mô tả</label>
                <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
            </div>
            
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.job.manager') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-success" style="background-color: #28a745; border-color: #28a745;">
                    <i class="fas fa-plus"></i> Thêm Job
                </button>
            </div>
        </form>
    </div>
</div>
@endsection