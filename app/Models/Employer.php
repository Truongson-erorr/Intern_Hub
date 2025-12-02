<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $table = 'employers';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'website',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $hidden = ['password'];
}
