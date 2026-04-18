@extends('user.layout.app')

@section('title', 'Gợi ý việc làm bằng AI')

@push('styles')
<style>
    .editorial-shadow {
        box-shadow: 0 4px 24px -2px rgba(15, 23, 42, 0.06);
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .electric-gradient {
        background: linear-gradient(135deg, #0052FF 0%, #4D7CFF 100%);
    }

    .ai-badge {
        background: linear-gradient(135deg,#6366f1,#22c55e);
        color:white;
        font-weight:600;
        padding:4px 10px;
        border-radius:999px;
        font-size:12px;
    }
</style>
@endpush

@section('content')

<main class="flex-grow pt-20 pb-24 px-8 max-w-[1440px] mx-auto w-full">

    <header class="mb-16 max-w-3xl">
        <h1 class="font-calistoga text-[3.5rem] leading-[1.3] mb-4">
            AI Job Recommendation
        </h1>

        <p class="text-lg opacity-80">
            Hệ thống AI phân tích hồ sơ, kỹ năng và ngành nghề của bạn để đề xuất
            các công việc phù hợp nhất.
        </p>
    </header>


    @if ($recommendedJobs->isEmpty())

        <section class="mt-8 bg-surface-container-low rounded-3xl p-16 flex flex-col items-center text-center">

            <div class="mb-8 p-6 bg-white rounded-full shadow-lg">
                <span class="material-symbols-outlined text-7xl text-blue-500">
                    smart_toy
                </span>
            </div>

            <h2 class="text-3xl mb-4">
                AI chưa đủ dữ liệu để gợi ý
            </h2>

            <p class="max-w-lg mb-10 opacity-80">
                Hãy cập nhật kỹ năng, ngành học hoặc kinh nghiệm để AI hiểu bạn hơn.
            </p>

            <a href="{{ route('user.profile.edit') }}"
                class="px-10 py-4 bg-black text-white rounded-md font-bold hover:scale-105 transition">
                Cập nhật hồ sơ ngay
            </a>

        </section>

    @else

        {{-- JOB GRID FULL --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach ($recommendedJobs as $job)

                <div class="bg-surface-container-lowest p-8 rounded-xl editorial-shadow hover:-translate-y-2 transition flex flex-col">

                    <div class="flex justify-between mb-4">

                        <span class="px-3 py-1 rounded-full text-sm font-bold bg-green-100 text-green-700">
                            {{ $job->ai_score ?? rand(75,95) }}% phù hợp
                        </span>

                        <span class="font-bold">
                            {{ $job->salary ?? 'Thỏa thuận' }}
                        </span>

                    </div>

                    <h3 class="text-lg font-semibold mb-2">
                        {{ $job->title }}
                    </h3>

                    <p class="text-sm opacity-70 mb-4">
                        📍 {{ $job->work_location ?? 'Không rõ' }}
                    </p>

                    <p class="text-sm line-clamp-2 mb-6">
                        {{ Str::limit(strip_tags($job->description),120) }}
                    </p>

                    <a href="{{ route('jobs.show',$job->id) }}"
                        class="mt-auto electric-gradient text-white py-3 rounded-md text-center">
                        Xem chi tiết
                    </a>

                </div>

            @endforeach

        </div>

    @endif

</main>

@endsection