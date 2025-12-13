@extends('admin.layout.index')

@section('title', 'Chỉnh sửa Công việc - ' . $job->title)

@section('content')
<style>
    :root {
        --primary: #4361ee;
        --primary-dark: #3551d6;
    }

    /* BODY CĂN GIỮA FORM */
    .edit-job-wrapper {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 3rem 1rem;
        background-color: #f8f9fa;
    }

    /* CARD HIỆN ĐẠI */
    .card-modern {
        border: none;
        border-radius: 16px;
        box-shadow: 0 6px 30px rgba(0,0,0,0.08);
        width: 100%;
        max-width: 700px;
        background: #fff;
        padding: 2rem;
    }

    /* TITLE */
    .page-title-modern {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.75rem;
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 2rem;
        color: #2d3748;
    }

    .page-title-modern i {
        color: var(--primary);
        font-size: 2rem;
    }

    /* FORM HIỆN ĐẠI */
    .form-label {
        font-weight: 600;
        color: #4a5568;
        display: block;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select, textarea {
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        padding: 0.75rem 1rem;
        width: 100%;
        transition: all 0.25s ease;
        font-size: 1rem;
        resize: vertical;
    }

    .form-control:focus, .form-select:focus, textarea:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(67,97,238,0.2);
    }

    /* KHUNG MARGIN CÁC Ô FORM */
    .form-group {
        margin-bottom: 1.5rem;
        display: flex;
        flex-direction: column;
    }

    /* BUTTON HIỆN ĐẠI */
    .btn-modern {
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.25s ease;
    }

    .btn-modern-primary {
        background-color: var(--primary);
        color: #fff;
        border: none;
    }

    .btn-modern-primary:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }

    .btn-modern-secondary {
        background-color: #edf2f7;
        color: var(--primary);
        border: none;
    }

    .btn-modern-secondary:hover {
        background-color: #e2e8f0;
        transform: translateY(-1px);
    }

    /* BUTTONS GROUP */
    .form-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 2rem;
        gap: 1rem;
    }

    /* TEXT ERROR */
    .text-danger {
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    /* RESPONSIVE NHẸ */
    @media(max-width: 640px) {
        .form-buttons {
            flex-direction: column;
        }
    }
</style>

<div class="edit-job-wrapper">
    <div class="card-modern">
        <h2 class="page-title-modern"><i class="fas fa-edit"></i> Chỉnh sửa Công việc</h2>

        <form method="POST" action="{{ route('admin.jobs.update', $job->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title" class="form-label">Tiêu đề Công việc</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $job->title) }}" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="company" class="form-label">Công ty</label>
                <input type="text" class="form-control" id="company" name="company" value="{{ old('company', $job->company) }}">
            </div>

            <div class="form-group">
                <label for="location" class="form-label">Địa điểm</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $job->location) }}">
            </div>

            <div class="form-group">
                <label for="salary" class="form-label">Mức Lương</label>
                <input type="text" class="form-control" id="salary" name="salary" value="{{ old('salary', $job->salary) }}">
            </div>

            <div class="form-group">
                <label for="experience" class="form-label">Kinh nghiệm</label>
                <input type="text" class="form-control" id="experience" name="experience" value="{{ old('experience', $job->experience) }}">
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Mô tả Công việc</label>
                <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description', $job->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="candidate_requirements" class="form-label">Yêu cầu Ứng viên</label>
                <textarea class="form-control" id="candidate_requirements" name="candidate_requirements" rows="3">{{ old('candidate_requirements', $job->candidate_requirements) }}</textarea>
            </div>

            <div class="form-group">
                <label for="deadline" class="form-label">Hạn nộp</label>
                <input type="date" class="form-control" id="deadline" name="deadline" value="{{ old('deadline', $job->deadline ? $job->deadline->format('Y-m-d') : '') }}">
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.job.manager') }}" class="btn btn-modern btn-modern-secondary">
                    Quay lại
                </a>
                <button type="submit" class="btn btn-modern btn-modern-primary">
                    Lưu Thay Đổi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
