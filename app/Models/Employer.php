<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $table = 'employers';

    protected $fillable = [
        'user_id',
        'company_name',
        'contact_email',
        'logo',
        'website',
        'address',
        'phone',
        'is_approved'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
