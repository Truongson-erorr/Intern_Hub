<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Job;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category'; 
    protected $fillable = ['name', 'description'];

    public function jobs()
    {
        return $this->hasMany(Job::class, 'category_id', 'id');
    }
}
