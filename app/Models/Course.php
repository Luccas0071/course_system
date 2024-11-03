<?php

namespace App\Models;

use App\Models\Module;
use App\Models\User;
use App\Traits\AssignUserId;
use App\Traits\GenerateUniqueCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Course extends Model
{
    use HasFactory, AssignUserId, GenerateUniqueCode;

    protected $table = 'courses';

    protected $fillable = [
        'unique_code',
        'title',
        'description',
        'user_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            $course->validate();
        });

        static::updating(function ($course) {
            $course->validate();
        });
    }
    
    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:255,',
        ], [
            'title.required' => 'O titulo é um campo obrigatório.',
            'description.required' => 'A descrição é um campo obrigatório.',
            'title.max' => 'O título pode ter até 100 caracteres.',
            'description.max' => 'A descrição pode ter até 255 caracteres.'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
