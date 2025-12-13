@extends('admin.layout.index')

@section('title', 'Quản lý Công ty')

@section('content')
{{-- Bổ sung CSS tùy chỉnh cho các nút (giả định CSS này được định nghĩa trong index.blade.php hoặc file CSS chung) --}}
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

<h2 class="fw-bold mb-4"><i class="fas fa-building"></i> Quản lý Công ty</h2>

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

<div class="card shadow border-0 rounded-4">
    <div class="card-body">

        <table class="table table-hover align-middle table-responsive">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên công ty</th>
                    <th>Email</th>
                    <th>Điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Website</th>
                    <th>Ngày tạo</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>

            <tbody>
                @forelse($employers as $employer)
                <tr>
                    <td>{{ $employer->id }}</td>
                    <td>{{ $employer->name }}</td>
                    <td>{{ $employer->email }}</td>
                    <td>{{ $employer->phone }}</td>
                    <td>{{ Str::limit($employer->address, 40) }}</td>
                    <td>{{ $employer->website }}</td>
                    <td>{{ $employer->created_at ? $employer->created_at->format('d/m/Y') : 'N/A' }}</td>
                    <td class="text-center d-flex justify-content-center gap-2">
                        
                        {{-- NÚT SỬA (Edit) - Trỏ tới admin.employers.edit (GET) --}}
                        <a href="{{ route('admin.employers.edit', $employer->id) }}" class="btn btn-sm btn-custom-edit" title="Chỉnh sửa">
                            <i class="fas fa-edit"></i>
                        </a>

                        {{-- NÚT XÓA (Delete) - Trỏ tới admin.employers.delete (DELETE) --}}
                        <form action="{{ route('admin.employers.delete', $employer->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa công ty {{ $employer->name }} không?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-custom-delete" title="Xóa công ty">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Không tìm thấy công ty nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        {{-- THÊM PHÂN TRANG (Giả định Controller sử dụng paginate) --}}
        @if (method_exists($employers, 'links'))
        <div class="d-flex justify-content-center mt-3">
            {{ $employers->links() }} 
        </div>
        @endif

    </div>
</div>

@endsection