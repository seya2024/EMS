<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;

//class User extends Authenticatable implements FilamentUser, HasAvatar, HasName
class User extends Authenticatable
{

    //implements FilamentUser

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'email',
        'phone',
        'address',
        'working_unit',
        'role',
        'password',
    ];


    // ...

    public function canAccessPanel(Panel $panel): bool
    {
        return str_ends_with($this->email, '@yourdomain.com') && $this->hasVerifiedEmail();
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];



    // public function getFilamentName(): string
    // {
    //     return trim("{$this->fname} {$this->mname} {$this->lname}");
    // }

    // public function getFilamentName(): string
    // {
    //     return trim("{$this->fname} {$this->mname} {$this->lname}") ?: $this->email;
    // }

    public function getFilamentName(): string
    {
        return "{$this->fname} {$this->mname}";
    }

    // public function getFilamentName(): string
    // {
    //     return $this->fname;
    // }

    public function canAccessFilament(): bool
    {
        return true;
        //return $this->role === 'Admin'; // or your logic
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    //     public function getFilamentName(): string
    // {
    //     return "{$this->fname} {$this->lname}";
    // }

}
