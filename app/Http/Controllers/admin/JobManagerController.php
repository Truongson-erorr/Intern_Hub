<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;

class JobManagerController extends Controller
{
    public function index()
    {
        $jobs = Job::orderBy('id', 'asc')->get(); 
        return view('admin.job_manager', compact('jobs'));
    }
}
