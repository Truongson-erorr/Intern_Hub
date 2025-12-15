<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;

class ApplicationManagerController extends Controller
{
    public function index()
    {
        $applications = JobApplication::with(['user', 'job'])
            ->orderByDesc('created_at')
            ->get();

        return view('admin.application_job_manager', compact('applications'));
    }
}
