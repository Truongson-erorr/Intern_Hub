<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::prefix('employer')->middleware('auth')->group(function () {
    Route::get('/index', function () {
        $user = Auth::user();

        abort_if(!$user || $user->role !== 'employer', 403);

        return view('employer.index');
    })->name('employer.dashboard');

    

});
