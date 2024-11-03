<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Validation\ValidationException;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->validate();
        });

        static::updating(function ($user) {
            $user->validate();
        });
    }
    
    public function validate()
    {
        $passwordRule = $this->id ? 'string|min:6' : 'required|string|min:6';

        $validator = Validator::make($this->attributes, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . ($this->id ?? 'NULL'),
            'password' => $passwordRule,
        ], [
            'name.required' => 'O nome é um campo obrigatório.',
            'email.required' => 'O e-mail é um campo obrigatório.',
            'email.unique' => 'Já existe um usuário cadastrado com este e-mail.',
            'email.email' => 'Email não é valido.',
            'password.required' => 'A senha é um campo obrigatório.',
            'password.min' => 'É necessário que a senha contenha no mínimo 6 caracteres.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    /**
     * Retorna a chave única do usuário para o JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Retorna um array com as informações do usuário para o JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function contents(): BelongsToMany
    {
        return $this->belongsToMany(Content::class, 'content_user', 'user_id', 'content_id');
    }

    public function viewedContents()
    {
        return $this->belongsToMany(Content::class, 'content_user', 'user_id', 'content_id');
    }

}
