<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsEmployer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Kiểm tra đã đăng nhập chưa và Role có đúng không
        if (!Auth::check() || Auth::user()->role !== 'employer') {
            // Nếu cố tình vào -> Đá về trang chủ hoặc lỗi 403
            abort(403, 'Bạn không có quyền truy cập trang Nhà tuyển dụng.');
        }

        // 2. (Nâng cao) Kiểm tra tài khoản đã được Admin duyệt chưa
        // Nhớ cấu hình quan hệ employer() trong model User như bài trước
        if (Auth::user()->employer && Auth::user()->employer->is_approved == 0) {
            abort(403, 'Tài khoản doanh nghiệp của bạn đang chờ phê duyệt.');
        }

        return $next($request);
    }
}
