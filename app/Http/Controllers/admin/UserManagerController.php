<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserManagerController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user_manager', compact('users'));
    }
}
