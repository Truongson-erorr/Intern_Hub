@extends('admin.layout.index')

@section('title', 'Quản lý Jobs')

@section('content')

<h2 class="fw-bold mb-4"><i class="fas fa-briefcase"></i> Quản lý Jobs</h2>

<div class="card shadow border-0 rounded-4">
    <div class="card-body">

        <table class="table table-hover align-middle table-responsive">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Địa điểm</th>
                    <th>Lương</th>
                    <th>Kinh nghiệm</th>
                    <th>Mô tả</th>
                    <th>Yêu cầu ứng viên</th>
                    <th>Thu nhập</th>
                    <th>Phúc lợi</th>
                    <th>Nơi làm việc</th>
                    <th>Thời gian làm việc</th>
                    <th>Hình thức ứng tuyển</th>
                    <th>Bằng cấp</th>
                    <th>Hạn nộp</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>

            <tbody>
                @foreach($jobs as $job)
                <tr>
                    <td>{{ $job->id }}</td>
                    <td>{{ $job->title }}</td>
                    <td>{{ $job->location }}</td>
                    <td>{{ $job->salary }}</td>
                    <td>{{ $job->experience }}</td>
                    <td>{{ $job->description }}</td>
                    <td>{{ $job->candidate_requirements }}</td>
                    <td>{{ $job->income }}</td>
                    <td>{{ $job->benefits }}</td>
                    <td>{{ $job->work_location }}</td>
                    <td>{{ $job->work_time }}</td>
                    <td>{{ $job->application_method }}</td>
                    <td>{{ $job->degree_requirements }}</td>
                    <td>{{ $job->deadline ? $job->deadline->format('d/m/Y') : '' }}</td>
                    <td class="text-center">
                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
