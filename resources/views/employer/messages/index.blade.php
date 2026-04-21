@extends('employer.layout.master')

@section('title', 'Quản lý tin nhắn đã gửi')

@section('content')
    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold"><i class="fas fa-paper-plane me-2 text-primary"></i>Lịch sử liên hệ sinh viên</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Sinh viên</th>
                                <th>Nội dung lời nhắn</th>
                                <th>Ngày gửi</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($messages as $msg)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $msg->receiver->avatar ? asset($msg->receiver->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($msg->receiver->name) }}"
                                                class="rounded-circle me-2" width="40" height="40">
                                            <div>
                                                <div class="fw-bold">{{ $msg->receiver->name }}</div>
                                                <small class="text-muted">{{ $msg->receiver->industry }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 300px;">
                                            {{ $msg->message_text }}
                                        </div>
                                    </td>
                                    <td>{{ $msg->created_at->format('H:i d/m/Y') }}</td>
                                    <td>
                                        @if ($msg->status === 'accepted')
                                            <span class="badge bg-success-subtle text-success border border-success">Sinh
                                                viên đã đồng ý</span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning border border-warning">Chờ xác
                                                nhận</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-light border" title="Xem chi tiết"
                                            onclick="viewMessageDetail('{{ $msg->receiver->name }}', '{{ $msg->message_text }}')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ asset($msg->receiver->cv_path) }}" target="_blank"
                                            class="btn btn-sm btn-light border" title="Xem CV">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            @if ($msg->status === 'accepted')
                                                {{-- Nút gửi email chỉ hiện khi sinh viên đã xác nhận --}}
                                                <a href="mailto:{{ $msg->receiver->email }}?subject=InternHub - Liên hệ phỏng vấn"
                                                    class="btn btn-sm btn-primary" title="Gửi Email ngay">
                                                    <i class="fas fa-envelope"></i> Gửi Email
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Bạn chưa gửi lời mời liên hệ nào.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $messages->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function viewMessageDetail(name, text) {
                Swal.fire({
                    title: 'Nội dung gửi cho ' + name,
                    text: text,
                    confirmButtonText: 'Đóng',
                    confirmButtonColor: '#0052FF'
                });
            }
        </script>
    @endpush
@endsection
