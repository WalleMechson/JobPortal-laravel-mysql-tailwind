<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Job extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ["title", "description", "salary", "location", "experience", "category"];
    public static $experience = ["entry", "intermediate", "senior"];
    public static $category = ["IT", "Finance", "Sales", "Marketing"];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function hasUserApplied(Authenticatable|User|int $user): bool
    {
        return $this->where('id', $this->id)->whereHas("jobApplications", fn($query) => $query->where('user_id', "=", $user->id ?? $user))->exists();
    }

    public function scopeFilter(Builder|QueryBuilder $query, array $filters)
    {
        return $query->when($filters['search'] ?? null, function ($query) use ($filters) {
            $query->where(function ($query) use ($filters) {
                $query->where('title', 'like', '%' . $filters['search'] . '%')->orWhere('description', 'like', '%' . $filters['search'] . '%')->orWhereHas('employer', function ($query) use ($filters) {
                    $query->where('company_name', 'like', "%" . $filters['search'] . "%");
                });
            });
        })->when($filters['min_salary'] ?? null, function ($query) use ($filters) {
            $query->where('salary', '>=', $filters['min_salary']);
        })->when($filters['max_salary'] ?? null, function ($query) use ($filters) {
            $query->where('salary', "<=", $filters['max_salary']);
        })->when($filters['experience'] ?? null, function ($query) use ($filters) {
            $query->where("experience", $filters['experience']);
        })->when($filters['category'] ?? null, function ($query) use ($filters) {
            $query->where("category", $filters['category']);
        });
    }
}
