<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use SoftDeletes;
    
    protected $table = 'teachers';
    protected $primaryKey = 'teacher_id';
    
    protected $fillable = [
        'full_name',
        'email',
        'contact_number',
    ];

    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'teacher_id');
    }
}
