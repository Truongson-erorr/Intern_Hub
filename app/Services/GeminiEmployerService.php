<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiEmployerService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        // Bạn nên để API Key trong file .env nhé: ANTHONY_GEMINI_KEY=xxxx
        $this->apiKey = env('ANTHONY_GEMINI_KEY', 'YOUR_API_KEY_HERE');
        $this->baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent';
    }

    public function getShortInsight($studentName, $industry, $position, $reasons)
    {
        $reasonText = implode(', ', $reasons);
        
        $prompt = "Bạn là trợ lý tuyển dụng của InternHub. 
        Hãy viết 1 câu duy nhất (dưới 15 chữ) giải thích lý do đề xuất sinh viên này cho nhà tuyển dụng.
        Thông tin: Tên {$studentName}, ngành {$industry}, muốn làm {$position}. 
        Lý do kỹ thuật: {$reasonText}.";

        try {
            $response = Http::post("{$this->baseUrl}?key={$this->apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Ứng viên tiềm năng với chỉ số khớp lệnh cao.';
            }
        } catch (\Exception $e) {
            Log::error('Anthony AI Error: ' . $e->getMessage());
        }

        return "Phù hợp với định hướng phát triển của công ty.";
    }
}