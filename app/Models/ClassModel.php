<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassModel extends Model
{
    use SoftDeletes;
    protected $table = 'classes';
    protected $primaryKey = 'class_id';
    protected $fillable = [
        'class_name',
        'age_range',
        'capacity',
        'school_year',
        'teacher_id'
    ];

    public function getNameAttribute()
    {
        return $this->class_name;
    }

    public function getGradeLevelAttribute()
    {
        return $this->age_range;
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'class_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
