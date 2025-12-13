@extends('admin.layout.index')

@section('title', 'Quản lý Công việc - InternHub')
@section('page-title', 'Quản lý Jobs')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Danh sách Bài đăng Công việc</h1>

{{-- Hiển thị thông báo (thành công/lỗi) --}}
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
        <i class="fas fa-check-circle mr-2"></i>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif
@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
        <i class="fas fa-times-circle mr-2"></i>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif

{{-- Bỏ bảng Lọc Trạng thái để tránh xung đột logic với JobManagerController::index() cũ của bạn --}}
<div class="mb-4 flex space-x-4">
    <span class="text-gray-500">Hiển thị tất cả công việc (Không áp dụng lọc trạng thái từ URL)</span>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">Danh sách Công việc</span>
    </div>
    <div class="card-body">
        <div class="overflow-x-auto">
            <table class="table min-w-full">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề Công việc</th>
                        <th>Công ty</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jobs as $job)
                        <tr>
                            <td>{{ $job->id }}</td>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->company ?? 'N/A' }}</td>
                            <td>
                                {{-- Giả định Status: 0=Chờ, 1=Duyệt, 2=Từ chối --}}
                                @if ($job->status == 1)
                                    <span class="badge badge-success">Đã duyệt</span>
                                @elseif ($job->status == 2)
                                    <span class="badge bg-danger text-white">Đã từ chối</span>
                                @else
                                    <span class="badge badge-warning">Chờ duyệt</span>
                                @endif
                            </td>
                            <td>{{ $job->created_at->format('d/m/Y') }}</td>
                            <td class="flex items-center justify-center space-x-3">
                                {{-- Form Duyệt (POST /jobs/{id}/approve) --}}
                                @if ($job->status == 0)
                                    <form action="{{ route('admin.jobs.approve', $job->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="text-white bg-green-500 hover:bg-green-600 px-3 py-1 rounded-lg text-xs font-semibold shadow-sm transition duration-150">
                                            <i class="fas fa-check"></i> Duyệt
                                        </button>
                                    </form>
                                @endif
                                
                                {{-- Nút Từ chối (PATCH /jobs/{id}/reject) --}}
                                @if ($job->status == 0)
                                    <form action="{{ route('admin.jobs.reject', $job->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-white bg-yellow-700 hover:bg-yellow-800 px-3 py-1 rounded-lg text-xs font-semibold shadow-sm transition duration-150">
                                            <i class="fas fa-times"></i> Từ chối
                                        </button>
                                    </form>
                                @endif

                                {{-- Nút Sửa (GET /jobs/{id}/edit) --}}
                                <a href="{{ route('admin.jobs.edit', $job->id) }}" class="text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded-lg text-xs font-semibold shadow-sm transition duration-150">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>

                                {{-- Form Xóa (DELETE /jobs/{id}) --}}
                                <form action="{{ route('admin.jobs.delete', $job->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài đăng «{{ $job->title }}» này không?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-gray-500 hover:bg-gray-600 px-3 py-1 rounded-lg text-xs font-semibold shadow-sm transition duration-150">
                                        <i class="fas fa-trash-alt"></i> Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-6">Không có bài đăng công việc nào trong danh sách.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Hiển thị liên kết phân trang (Nếu JobManagerController::index() có dùng paginate) --}}
<div class="mt-6 flex justify-center">
    {{-- ĐÃ SỬA: Thay admin.jobs.index bằng admin.job.manager --}}
    {{-- Loại bỏ appends(['type' => $type ?? 'pending']) vì logic $type đã bị bỏ --}}
    {{-- @if (method_exists($jobs, 'links')) {{ $jobs->links() }} @endif --}}
</div>
@endsection