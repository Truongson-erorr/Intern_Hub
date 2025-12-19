@extends('employer.layout.master')

@section('title', 'Hồ sơ công ty')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Hồ sơ công ty</h2>
    </div>

    {{-- Hiển thị thông báo thành công --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('employer.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card card-modern h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold mb-4">Logo Doanh Nghiệp</h5>
                        
                        <div class="mb-3">
                            @if($employer->logo)
                                <img src="{{ asset('storage/' . $employer->logo) }}" 
                                     alt="Logo" 
                                     class="img-thumbnail rounded-circle" 
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <img src="https://via.placeholder.com/150?text=No+Logo" 
                                     alt="No Logo" 
                                     class="img-thumbnail rounded-circle"
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            @endif
                        </div>

                        <div class="mb-3 text-start">
                            <label for="logo" class="form-label fw-bold">Thay đổi Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                            <small class="text-muted">Định dạng: JPG, PNG. Tối đa 2MB.</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 mb-4">
                <div class="card card-modern h-100">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="fw-bold mb-0 text-primary">Thông tin chung</h5>
                    </div>
                    <div class="card-body">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên công ty <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="company_name" 
                                   value="{{ old('company_name', $employer->company_name) }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Email liên hệ <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="contact_email" 
                                       value="{{ old('contact_email', $employer->contact_email) }}" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" 
                                       value="{{ old('phone', $employer->phone) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Website</label>
                            <input type="url" class="form-control" name="website" placeholder="https://website.com"
                                   value="{{ old('website', $employer->website) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Địa chỉ trụ sở</label>
                            <input type="text" class="form-control" name="address" 
                                   value="{{ old('address', $employer->address) }}">
                        </div>

                        <hr>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-bold shadow-sm">
                                <i class="fas fa-save me-2"></i> Lưu thay đổi
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection