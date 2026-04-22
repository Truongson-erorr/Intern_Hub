<?php

namespace App\Services;

use App\Models\User;
use App\Models\Job;
use Illuminate\Support\Facades\DB;

class RecommendationService
{
    public function getScoredCandidates($employerId)
    {
        // 1. Lấy ngữ cảnh: Nhà tuyển dụng này đang cần tìm những gì?
        $employerJobs = Job::where('employer_id', $employerId)->get();
        if ($employerJobs->isEmpty()) {
            return [
                'top' => collect(),
                'others' => collect()
            ];
        }

        $targetCategories = $employerJobs->pluck('category_id')->unique();
        $targetTitles = $employerJobs->pluck('title');

        // 2. Lấy toàn bộ sinh viên đang ở chế độ Public
        $candidates = User::where('role', 'user')
            ->where('is_public', 1)
            ->whereNotNull('cv_path')
            ->get();

        // 3. Tính toán Matching Score cho từng sinh viên
        $scoredList = $candidates->map(function ($student) use ($targetCategories, $targetTitles) {
            $score = 0;
            $matchReasons = [];

            // --- TIÊU CHÍ 1: Khớp Vị trí (40 điểm) ---
            foreach ($targetTitles as $title) {
                if ($student->desired_position && stripos($title, $student->desired_position) !== false) {
                    $score += 40;
                    $matchReasons[] = "Vị trí mong muốn khớp với tin tuyển dụng của bạn";
                    break;
                }
            }

            // --- TIÊU CHÍ 2: Khớp Chuyên ngành (30 điểm) ---
            if ($student->industry) {
                foreach ($targetTitles as $title) {
                    if (stripos($title, $student->industry) !== false) {
                        $score += 30;
                        $matchReasons[] = "Chuyên ngành phù hợp với lĩnh vực công ty";
                        break;
                    }
                }
            }

            // --- TIÊU CHÍ 3: Hành vi (30 điểm) ---
            $studentInterests = DB::table('saved_jobs')
                ->join('jobs', 'saved_jobs.job_id', '=', 'jobs.id')
                ->where('user_id', $student->id)
                ->pluck('jobs.category_id')
                ->toArray();

            if (count(array_intersect($studentInterests, $targetCategories->toArray())) > 0) {
                $score += 30;
                $matchReasons[] = "Sinh viên thường xuyên quan tâm đến các vị trí tương tự công ty bạn";
            }

            $student->matching_score = $score;
            $student->reasons = $matchReasons; // Lưu lại để hiện lên UI
            return $student;
        });

        // Lấy danh sách đã sắp xếp theo điểm
        $sortedList = $scoredList->sortByDesc('matching_score');

        // Tách ra Top 3 người để gọi AI Insight
        $topCandidates = $sortedList->take(3);
        $otherCandidates = $sortedList->skip(3);

        // Khởi tạo Service AI của bạn
        $aiService = new \App\Services\GeminiEmployerService();

        foreach ($topCandidates as $student) {
            // Chỉ gọi AI cho Top 3 người đứng đầu
            $student->ai_insight = $aiService->getShortInsight(
                $student->name,
                $student->industry,
                $student->desired_position,
                $student->reasons
            );
        }

        return [
            'top' => $topCandidates,
            'others' => $otherCandidates
        ];
    }
}
