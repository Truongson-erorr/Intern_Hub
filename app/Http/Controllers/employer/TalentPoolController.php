<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Services\GeminiEmployerService;
use App\Services\RecommendationService;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TalentPoolController extends Controller
{
    protected $recService;
    protected $aiService;

    public function __construct(RecommendationService $recService, GeminiEmployerService $aiService)
    {
        $this->recService = $recService;
        $this->aiService = $aiService;
    }

    public function index(Request $request)
    {
        $query = User::where('role', 'user')
            ->where('is_public', 1)
            ->whereNotNull('cv_path')
            ->where('cv_path', '!=', '');

        if ($request->filled('industry')) {
            $query->where('industry', $request->industry);
        }

        if ($request->filled('position')) {
            $query->where('desired_position', 'like', '%' . $request->position . '%');
        }

        $students = $query->latest()->paginate(12);

        return view('employer.talent_pool.index', compact('students'));
    }

    public function recommendedTalents()
    {
        $employer = Auth::user()->employer;

        // Lấy kết quả từ Service (trả về array)
        $scoredCandidates = $this->recService->getScoredCandidates($employer->id);

        // SỬA LỖI TẠI ĐÂY: Kiểm tra xem cả 2 danh sách có trống không
        if ($scoredCandidates['top']->isEmpty() && $scoredCandidates['others']->isEmpty()) {
            return view('employer.talent_pool.recommended', [
                'recommended' => $scoredCandidates
            ])->with('info', 'Hãy đăng tin tuyển dụng để nhận gợi ý!');
        }

        // Gọi AI cho Top 3
        foreach ($scoredCandidates['top'] as $student) {
            $student->ai_insight = $this->aiService->getShortInsight(
                $student->name,
                $student->industry,
                $student->desired_position,
                $student->reasons ?? []
            );
        }

        return view('employer.talent_pool.recommended', [
            'recommended' => $scoredCandidates
        ]);
    }
}
