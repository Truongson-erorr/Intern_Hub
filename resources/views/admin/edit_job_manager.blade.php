@extends('admin.layout.index')

@section('title', 'Chỉnh sửa Công việc - ' . $job->title)
@section('page-title', 'Chỉnh sửa Công việc')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Chỉnh sửa Bài đăng: {{ $job->title }}</h1>

<div class="card shadow border-0 rounded-4">
    <div class="card-body p-5">
        {{-- Form chỉnh sửa sẽ sử dụng phương thức PUT/PATCH --}}
        {{-- Giả định Route update là 'admin.jobs.update' --}}
        <form method="POST" action="{{ route('admin.jobs.update', $job->id) }}">
            @csrf
            @method('PUT') 

            {{-- 1. Tiêu đề Công việc --}}
            <div class="mb-4">
                <label for="title" class="form-label font-weight-bold">Tiêu đề Công việc</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $job->title) }}" required>
                @error('title')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- 2. Địa điểm --}}
            <div class="mb-4">
                <label for="location" class="form-label font-weight-bold">Địa điểm</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $job->location) }}">
            </div>

            {{-- 3. Lương --}}
            <div class="mb-4">
                <label for="salary" class="form-label font-weight-bold">Mức Lương</label>
                <input type="text" class="form-control" id="salary" name="salary" value="{{ old('salary', $job->salary) }}">
            </div>

            {{-- 4. Kinh nghiệm --}}
            <div class="mb-4">
                <label for="experience" class="form-label font-weight-bold">Kinh nghiệm</label>
                <input type="text" class="form-control" id="experience" name="experience" value="{{ old('experience', $job->experience) }}">
            </div>

            {{-- 5. Mô tả Công việc --}}
            <div class="mb-4">
                <label for="description" class="form-label font-weight-bold">Mô tả Công việc</label>
                <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description', $job->description) }}</textarea>
            </div>
            
            {{-- 6. Yêu cầu ứng viên --}}
            <div class="mb-4">
                <label for="candidate_requirements" class="form-label font-weight-bold">Yêu cầu Ứng viên</label>
                <textarea class="form-control" id="candidate_requirements" name="candidate_requirements" rows="3">{{ old('candidate_requirements', $job->candidate_requirements) }}</textarea>
            </div>

            {{-- 7. Thu nhập --}}
            <div class="mb-4">
                <label for="income" class="form-label font-weight-bold">Thu nhập</label>
                <input type="text" class="form-control" id="income" name="income" value="{{ old('income', $job->income) }}">
            </div>
            
            {{-- 8. Phúc lợi --}}
            <div class="mb-4">
                <label for="benefits" class="form-label font-weight-bold">Phúc lợi</label>
                <textarea class="form-control" id="benefits" name="benefits" rows="3">{{ old('benefits', $job->benefits) }}</textarea>
            </div>

            {{-- 9. Nơi làm việc --}}
            <div class="mb-4">
                <label for="work_location" class="form-label font-weight-bold">Nơi làm việc</label>
                <input type="text" class="form-control" id="work_location" name="work_location" value="{{ old('work_location', $job->work_location) }}">
            </div>

            {{-- 10. Thời gian làm việc --}}
            <div class="mb-4">
                <label for="work_time" class="form-label font-weight-bold">Thời gian làm việc</label>
                <input type="text" class="form-control" id="work_time" name="work_time" value="{{ old('work_time', $job->work_time) }}">
            </div>

            {{-- 11. Hình thức ứng tuyển --}}
            <div class="mb-4">
                <label for="application_method" class="form-label font-weight-bold">Hình thức ứng tuyển</label>
                <input type="text" class="form-control" id="application_method" name="application_method" value="{{ old('application_method', $job->application_method) }}">
            </div>

            {{-- 12. Bằng cấp --}}
            <div class="mb-4">
                <label for="degree_requirements" class="form-label font-weight-bold">Yêu cầu Bằng cấp</label>
                <input type="text" class="form-control" id="degree_requirements" name="degree_requirements" value="{{ old('degree_requirements', $job->degree_requirements) }}">
            </div>

            {{-- 13. Hạn nộp --}}
            <div class="mb-4">
                <label for="deadline" class="form-label font-weight-bold">Hạn nộp</label>
                {{-- Lưu ý: Nếu cột deadline là kiểu Date/Datetime, bạn có thể cần định dạng lại giá trị cho input type="date" --}}
                <input type="date" class="form-control" id="deadline" name="deadline" value="{{ old('deadline', $job->deadline ? $job->deadline->format('Y-m-d') : '') }}">
            </div>


            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.job.manager') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-primary" style="background-color: var(--primary); border-color: var(--primary);">
                    <i class="fas fa-save"></i> Lưu Thay Đổi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection