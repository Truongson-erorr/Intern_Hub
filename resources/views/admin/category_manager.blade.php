@extends('admin.layout.index')

@section('title', 'Quản lý Danh mục')

@section('content')
{{-- Bổ sung CSS tùy chỉnh cho các nút --}}
<style>
    /* CSS TÙY CHỈNH CHO NÚT HÀNH ĐỘNG */
    .btn-custom-edit {
        background-color: #e0f7fa; /* Xanh nhạt */
        color: #00838f; /* Xanh đậm */
        border: 1px solid #b2ebf2;
        transition: all 0.2s;
    }
    .btn-custom-edit:hover {
        background-color: #b2ebf2;
    }
    .btn-custom-delete {
        background-color: #ffebee; /* Đỏ nhạt */
        color: #c62828; /* Đỏ đậm */
        border: 1px solid #ffcdd2;
        transition: all 0.2s;
    }
    .btn-custom-delete:hover {
        background-color: #ffcdd2;
    }
</style>

<h2 class="fw-bold mb-4"><i class="fas fa-list"></i> Quản lý Danh mục việc làm</h2>

{{-- Hiển thị thông báo --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- FORM TẠO DANH MỤC MỚI (CREATE) --}}
<div class="card shadow border-0 rounded-4 mb-4">
    <div class="card-header bg-dark text-white rounded-top-4">Tạo Danh mục mới</div>
    <div class="card-body">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="name" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>
                <div class="col-md-2 d-flex align-items-end mb-3">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-plus"></i> Thêm
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- BẢNG HIỂN THỊ DANH MỤC (READ) --}}
<div class="card shadow border-0 rounded-4">
    <div class="card-body">

        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Ngày tạo</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>

            <tbody>
                @forelse($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->description }}</td>
                    <td>{{ $cat->created_at ? \Carbon\Carbon::parse($cat->created_at)->format('d/m/Y') : 'N/A' }}</td>
                    <td class="text-center d-flex justify-content-center gap-2">
                        
                        {{-- NÚT SỬA (Edit) - Trỏ tới admin.categories.edit (GET) --}}
                        <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-sm btn-custom-edit" title="Chỉnh sửa">
                            <i class="fas fa-edit"></i>
                        </a>

                        {{-- NÚT XÓA (Delete) - Trỏ tới admin.categories.delete (DELETE) --}}
                        <form action="{{ route('admin.categories.delete', $cat->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục {{ $cat->name }} không?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-custom-delete" title="Xóa danh mục">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Không tìm thấy danh mục nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- THÊM PHÂN TRANG (Nếu Controller dùng paginate) --}}
        @if (method_exists($categories, 'links'))
        <div class="d-flex justify-content-center mt-3">
            {{ $categories->links() }} 
        </div>
        @endif
        
    </div>
</div>

@endsection