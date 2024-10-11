<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = ["company_name"];

    public function jobs(){
        return $this->hasMany(Job::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
