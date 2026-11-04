<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'kode',
        'nama',
        'deskripsi',
        'user_id',
    ];

    protected $casts = [
        'sks' => 'integer',
    ];

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function approvedStudents(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id')
            ->where('course_user.status', 'approved')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function pendingStudents(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id')
            ->where('course_user.status', 'pending')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function materials(): HasMany
    {
        return $this->hasMany(Material::class, 'course_id')->orderBy('minggu_ke')->orderBy('urutan');
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class, 'course_id')->orderBy('deadline');
    }
}