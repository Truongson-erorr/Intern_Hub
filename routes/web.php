<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('employer.layout.index');
});
Route::get('authen/login', function () {
    return view('authen.login'); 
});


