<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employer;

class EmployerManagerController extends Controller
{
    public function index()
    {
        $employers = Employer::orderBy('id', 'desc')->get();

        return view('admin.employer_manager', compact('employers'));
    }
}
