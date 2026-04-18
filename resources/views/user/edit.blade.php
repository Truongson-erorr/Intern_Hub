@extends('user.layout.app')

@section('title', 'Chỉnh sửa thông tin cá nhân')

@section('content')
    <div class="max-w-4xl mx-auto">
        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-8 p-4 bg-primary-fixed text-on-primary-fixed rounded-xl flex items-center gap-3 editorial-shadow">
                <span class="material-symbols-outlined text-primary">check_circle</span>
                <p class="font-medium text-sm">{{ session('success') }}</p>
            </div>
        @endif

        <div class="flex flex-col md:flex-row gap-12">
            {{-- Left Column: Avatar --}}
            <div class="w-full md:w-1/3 flex flex-col items-center text-center">
                <form id="avatar-form" action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data"
                    class="relative group">
                    @csrf
                    <input type="file" name="avatar" id="avatar-input" accept="image/*" class="hidden"
                        onchange="document.getElementById('avatar-form').submit()" />
                    <div
                        class="w-48 h-48 rounded-full p-1 bg-gradient-to-tr from-primary to-secondary-container editorial-shadow">
                        <div class="w-full h-full rounded-full border-4 border-white overflow-hidden bg-surface-container">
                            <img id="avatar-preview" class="w-full h-full object-cover"
                                src="{{ $user->avatar ? asset($user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                                alt="Avatar" />
                        </div>
                    </div>
                    <button type="button" onclick="document.getElementById('avatar-input').click()"
                        class="absolute bottom-2 right-2 w-12 h-12 electric-gradient text-white rounded-full flex items-center justify-center shadow-lg hover:scale-105 transition-transform">
                        <span class="material-symbols-outlined">camera</span>
                    </button>
                </form>
                <div class="mt-6">
                    <p class="text-sm font-bold text-primary uppercase tracking-widest mb-1">Thành viên Premium</p>
                    <button type="button" onclick="document.getElementById('avatar-input').click()"
                        class="text-blue-600 font-medium text-sm hover:underline">Chọn ảnh mới</button>
                </div>
            </div>

            {{-- Right Column: Form --}}
            <div class="w-full md:w-2/3">
                <header class="mb-12">
                    <h1 class="text-[3.5rem] font-['Calistoga'] leading-[1.3] text-on-background -tracking-[0.02em] mb-4">
                        Cập Nhật Hồ Sơ
                    </h1>
                    <p class="text-on-surface-variant leading-[1.7] max-w-lg">Cập nhật thông tin chi tiết để các nhà tuyển
                        dụng hàng đầu có thể tìm thấy bạn dễ dàng hơn.</p>
                </header>

                <form method="POST" action="{{ route('user.profile.update') }}" class="space-y-10">
                    @csrf

                    {{-- Họ và tên + Email --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[0.6875rem] font-bold uppercase tracking-wider text-outline">Họ và
                                tên</label>
                            <input name="name"
                                class="w-full bg-transparent border-0 border-b-2 border-surface-container-highest focus:ring-0 focus:border-primary transition-all py-3 text-on-background font-medium"
                                type="text" value="{{ old('name', $user->name) }}" required />
                        </div>
                        <div class="space-y-2 opacity-60">
                            <label class="text-[0.6875rem] font-bold uppercase tracking-wider text-outline">Email</label>
                            <input
                                class="w-full bg-transparent border-0 border-b-2 border-surface-container-highest py-3 text-on-background font-medium cursor-not-allowed"
                                disabled type="email" value="{{ $user->email }}" />
                        </div>
                    </div>

                    {{-- Số điện thoại + Ngành nghề --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[0.6875rem] font-bold uppercase tracking-wider text-outline">Số điện
                                thoại</label>
                            <input name="phone"
                                class="w-full bg-transparent border-0 border-b-2 border-surface-container-highest focus:ring-0 focus:border-primary transition-all py-3 text-on-background font-medium"
                                type="tel" value="{{ old('phone', $user->phone) }}" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-[0.6875rem] font-bold uppercase tracking-wider text-outline">Ngành nghề
                                chính</label>
                            <input name="industry"
                                class="w-full bg-transparent border-0 border-b-2 border-surface-container-highest focus:ring-0 focus:border-primary transition-all py-3 text-on-background font-medium"
                                type="text" value="{{ old('industry', $user->industry) }}"
                                placeholder="VD: Công nghệ thông tin" />
                        </div>
                    </div>

                    {{-- Địa chỉ --}}
                    <div class="space-y-2">
                        <label class="text-[0.6875rem] font-bold uppercase tracking-wider text-outline">Địa chỉ</label>
                        <input name="address"
                            class="w-full bg-transparent border-0 border-b-2 border-surface-container-highest focus:ring-0 focus:border-primary transition-all py-3 text-on-background font-medium"
                            type="text" value="{{ old('address', $user->address) }}" />
                    </div>

                    {{-- Hồ sơ --}}
                    <div class="space-y-2">
                        <label class="text-[0.6875rem] font-bold uppercase tracking-wider text-outline">Hồ sơ</label>
                        <textarea name="resume"
                            class="w-full bg-surface-container-low border-0 focus:ring-2 focus:ring-primary/20 rounded-xl p-4 text-on-background leading-[1.7] transition-all"
                            placeholder="Giới thiệu ngắn gọn về kinh nghiệm và kỹ năng của bạn..." rows="5">{{ old('resume', $user->resume) }}</textarea>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end gap-6 pt-8">
                        <a href="{{ url('user/trangchu') }}"
                            class="px-8 py-3 border border-outline text-on-surface-variant font-bold rounded-lg hover:bg-surface-container transition-colors uppercase tracking-widest text-[0.6875rem]">
                            Quay lại
                        </a>
                        <button type="submit"
                            class="px-10 py-3 electric-gradient text-white font-bold rounded-lg editorial-shadow hover:opacity-90 active:scale-95 transition-all uppercase tracking-widest text-[0.6875rem]">
                            Lưu thay đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Preview avatar khi chọn file (nếu muốn xem trước trước khi submit)
        document.getElementById('avatar-input').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('avatar-preview').src = event.target.result;
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    </script>
@endpush
