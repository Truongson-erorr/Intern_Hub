<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    // Hiển thị danh sách jobs ở trang user
    public function index()
    {
        $jobs = Job::orderBy('created_at', 'desc')->get();
        return view('user.trangchu', compact('jobs'));
    }
}
