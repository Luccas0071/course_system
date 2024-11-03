<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait GenerateUniqueCode
{
    protected static function bootGenerateUniqueCode()
    {
        static::creating(function ($model) {
            $model->unique_code = (string) Str::uuid();
        });
    }
}