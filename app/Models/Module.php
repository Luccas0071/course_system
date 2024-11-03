<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Content;
use App\Models\User;
use App\Traits\AssignUserId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Module extends Model
{
    use HasFactory, AssignUserId;

    protected $table = 'modules';

    protected $fillable = [
        'title',
        'description',
        'course_id',
        'user_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($module) {
            $module->validate();
        });

        static::updating(function ($module) {
            $module->validate();
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

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
