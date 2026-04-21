<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::where('sender_id', Auth::id())
            ->with('receiver')
            ->latest()
            ->paginate(15);

        return view('employer.messages.index', compact('messages'));
    }
    public function sendMessage(Request $request)
    {
        // 1. Validate dữ liệu
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message_text' => 'required|string|max:1000',
        ]);

        // 2. Kiểm tra nếu người gửi và người nhận là cùng 1 người (tùy chọn)
        if (Auth::id() == $request->receiver_id) {
            return back()->with('error', 'Bạn không thể tự gửi tin nhắn cho chính mình.');
        }

        try {
            // 3. Tạo tin nhắn
            Message::create([
                'sender_id'   => Auth::id(), // Sử dụng Helper Id() để tránh lỗi visibility
                'receiver_id' => $request->receiver_id,
                'message_text'     => $request->message_text,
                'is_read'     => 0,
            ]);

            return back()->with('success', 'Đã gửi lời mời liên hệ thành công!');
        } catch (\Exception $e) {
            // Trả về lỗi nếu có vấn đề database
            return back()->with('error', 'Lỗi hệ thống: ' . $e->getMessage());
        }
    }
}
