<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $primaryKey = 'grade_id';

    protected $fillable = [
        'grade_number',
        'section_id',
        'subject_id',
        'fee_amount',
    ];

    public function section()
    {
        return $this->belongsTo(ClassModel::class, 'section_id', 'class_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'grade_id', 'grade_id');
    }
}
