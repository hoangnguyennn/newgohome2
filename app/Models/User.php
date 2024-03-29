<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'fullname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    private $rootAccountEmails = [
        'nvanhoang188@gmail.com'
    ];

    public function hasVerifiedEmail()
    {
        return $this->is_verify == true;
    }

    public function isAdmin()
    {
        return $this->role == 'admin';
    }

    public function isEditor() {
        return $this->role == 'editor';
    }

    public function isRoot()
    {
        return in_array($this->email, $this->rootAccountEmails);
    }

    public function hasRole($role)
    {
        return $this->role == $role;
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }
}
