<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guardian extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'guardian_id';
    protected $fillable = [
        'full_name', 
        'email', 
        'phone_number', 
        'relationship', 
        'address'
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'guardian_id');
    }
}
