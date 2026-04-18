<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    public static function suggestJobs($industry, $experience, $expectedSalary, $jobs)
    {
        $apiKey = config('ai.gemini_key');

        if (!$apiKey) {
            Log::error('❌ GEMINI API KEY NOT FOUND');
            return [];
        }

        Log::info('🚀 AI CALL START');

        $jobText = $jobs->take(20)->map(function ($job) {
            return "
        ID: {$job->id}
        Title: {$job->title}
        Salary: {$job->salary}
        Experience: {$job->experience}
        ----------------";
                })->implode("\n");

                $prompt = "
        You are a job matching AI.

        Candidate:
        - Industry: {$industry}
        - Experience: {$experience}
        - Expected Salary: {$expectedSalary}

        Jobs:
        {$jobText}

        Task:
        - Rank best matching jobs
        - Return ONLY IDs (comma separated)

        Example:
        1,5,8

        No explanation.
        Only numbers.
        ";

        try {

            $response = Http::timeout(30)->post(
                "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}",
                [
                    "contents" => [
                        [
                            "parts" => [
                                ["text" => $prompt]
                            ]
                        ]
                    ]
                ]
            );

            if (!$response->successful()) {
                Log::error('❌ GỌI GEMINI THẤT BẠI', [
                    'mã_trạng_thái' => $response->status(),
                    'phản_hồi' => $response->body()
                ]);

                return [];
            }

            Log::info('✅ GỌI AI THÀNH CÔNG', [
                'mã_trạng_thái' => $response->status()
            ]);

            $text = $response['candidates'][0]['content']['parts'][0]['text'] ?? '';

            Log::info('🤖 KẾT QUẢ AI TRẢ VỀ', [
                'nội_dung' => $text
            ]);

            $ids = collect(explode(',', $text))
                ->map(fn($id) => (int) trim($id))
                ->filter()
                ->values()
                ->toArray();

            Log::info('🎯 DANH SÁCH JOB GỢI Ý', [
                'ids' => $ids
            ]);

            return $ids;

        } catch (\Exception $e) {
            Log::error('🔥 GEMINI ERROR', [
                'message' => $e->getMessage()
            ]);

            return [];
        }
    }
}