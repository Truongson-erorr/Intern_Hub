@extends('employer.layout.master')

@section('title', 'Quản lý tin tuyển dụng')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">Tin Tuyển Dụng</h3>
        <a href="{{ route('employer.jobs.create') }}" class="btn btn-primary rounded px-4 shadow-sm">
            <i class="fas fa-plus me-2"></i> Đăng tin mới
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card card-modern">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>Tiêu đề / Vị trí</th>
                            <th>Mức lương</th>
                            <th>Hạn nộp</th>
                            <th>Trạng thái</th>
                            <th class="text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobs as $job)
                            <tr>
                                <td>
                                    <h6 class="mb-0 fw-bold">{{ $job->title }}</h6>
                                    <small class="text-muted">{{ $job->category->name ?? 'Chưa phân loại' }}</small>
                                </td>
                                <td>{{ $job->salary }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($job->deadline)->format('d/m/Y') }}
                                    @if (\Carbon\Carbon::parse($job->deadline)->isPast())
                                        <span class="badge bg-danger ms-1">Hết hạn</span>
                                    @endif
                                </td>
                                <td><span class="badge bg-success">Đang hiển thị</span></td>
                                <td class="text-end">
                                    <a href="{{ route('employer.jobs.edit', $job->id) }}"
                                        class="btn btn-sm btn-outline-primary me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('employer.jobs.destroy', $job->id) }}" method="POST"
                                        class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Xác nhận xóa',
                        html: '<strong>Tin tuyển dụng</strong> sẽ bị xóa vĩnh viễn.<br>Bạn có chắc chắn không?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Xóa',
                        cancelButtonText: 'Hủy'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
