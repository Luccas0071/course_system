<?php

namespace App\Models;

use App\Models\Module;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Content extends Model
{
    protected $table = 'contents';

    protected $fillable = [
        'title',
        'contents',
        'module_id'
    ];
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($content) {
            $content->validate();
        });

        static::updating(function ($content) {
            $content->validate();
        });
    }
    
    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'title' => 'required|string|max:100',
            'contents' => 'required|string|max:255,',
        ], [
            'title.required' => 'O titulo é um campo obrigatório.',
            'contents.required' => 'O conteúdo é um campo obrigatório.',
            'title.max' => 'O título pode ter até 100 caracteres.',
            'contents.max' => 'O conteúdo pode ter até 255 caracteres.'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function course()
    {
        return $this->module->course();
    }
    
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'content_user', 'content_id', 'user_id');
    }

    public function viewedByUser($userId)
    {
        return $this->users()->where('user_id', $userId)->exists();
    }
}
