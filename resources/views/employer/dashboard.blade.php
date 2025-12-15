@extends('employer.layout.master')

@section('title', 'Bảng điều khiển')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Dashboard</h2>
        <a href="#" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="fas fa-plus me-2"></i> Đăng tin mới
        </a>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card card-modern bg-white h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted text-uppercase fw-bold mb-1">Tin đang tuyển</h6>
                        <h2 class="mb-0 fw-bold text-primary">05</h2>
                    </div>
                    <div class="icon-box bg-light rounded-circle p-3 text-primary">
                        <i class="fas fa-briefcase fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-modern bg-white h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted text-uppercase fw-bold mb-1">CV Chờ duyệt</h6>
                        <h2 class="mb-0 fw-bold text-warning">12</h2>
                    </div>
                    <div class="icon-box bg-light rounded-circle p-3 text-warning">
                        <i class="fas fa-user-clock fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-modern bg-white h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted text-uppercase fw-bold mb-1">Lượt xem tin</h6>
                        <h2 class="mb-0 fw-bold text-success">1,250</h2>
                    </div>
                    <div class="icon-box bg-light rounded-circle p-3 text-success">
                        <i class="fas fa-eye fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-modern">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="fw-bold mb-0">Ứng viên mới nhất</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>Ứng viên</th>
                        <th>Vị trí</th>
                        <th>Ngày nộp</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://via.placeholder.com/30" class="rounded-circle me-2">
                                <strong>Nguyễn Văn A</strong>
                            </div>
                        </td>
                        <td>Laravel Developer</td>
                        <td>12/12/2025</td>
                        <td><span class="badge bg-warning text-dark">Chờ duyệt</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary">Xem CV</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection