@extends('admin.layout.index')

@section('title', 'Tạo Công ty mới')
@section('page-title', 'Tạo Công ty')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Thêm Công ty Mới (Employer)</h1>

<div class="card shadow border-0 rounded-4">
    <div class="card-body p-5">
        <form method="POST" action="{{ route('admin.employers.store') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="form-label font-weight-bold">Tên Công ty</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            
            <div class="mb-4">
                <label for="email" class="form-label font-weight-bold">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            
            <div class="mb-4">
                <label for="phone" class="form-label font-weight-bold">Điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.employer.manager') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-success" style="background-color: #28a745; border-color: #28a745;">
                    <i class="fas fa-plus"></i> Thêm Công ty
                </button>
            </div>
        </form>
    </div>
</div>
@endsection