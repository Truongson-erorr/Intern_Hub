@extends('admin.layout.index')

@section('title', 'Quản lý User')

@section('content')
{{-- Bổ sung CSS tùy chỉnh cho các nút (giả định CSS này được định nghĩa trong index.blade.php hoặc file CSS chung) --}}
<style>
    /* CSS TÙY CHỈNH CHO NÚT HÀNH ĐỘNG (Áp dụng từ Job Manager) */
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

<h2 class="fw-bold mb-4"><i class="fas fa-users"></i> Quản lý User</h2>

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

        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Ngày tạo</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->created_at->format('d/m/Y') }}</td>
                    <td class="text-center d-flex justify-content-center gap-2">
                        
                        {{-- NÚT SỬA (Edit) - Trỏ tới admin.users.edit (GET) --}}
                        <a href="{{ route('admin.users.edit', $u->id) }}" class="btn btn-sm btn-custom-edit" title="Chỉnh sửa">
                            <i class="fas fa-edit"></i>
                        </a>

                        {{-- NÚT XÓA (Delete) - Trỏ tới admin.users.delete (DELETE) --}}
                        <form action="{{ route('admin.users.delete', $u->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa user {{ $u->name }} không?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-custom-delete" title="Xóa user">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Không tìm thấy user nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        {{-- THÊM PHÂN TRANG (Nếu Controller dùng paginate) --}}
        @if (method_exists($users, 'links'))
        <div class="d-flex justify-content-center mt-3">
            {{ $users->links() }} 
        </div>
        @endif

    </div>
</div>

@endsection