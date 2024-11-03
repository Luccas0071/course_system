<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait AssignUserId
{
    protected static function bootAssignUserId()
    {
        static::creating(function ($model) {
            $model->user_id = Auth::id();
        });
    }
}