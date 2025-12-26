<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use id;
use Filament\Panel;
use App\Models\DataVPN;
use App\Models\FixedLine;
use Filament\Models\Contracts\HasName;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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


    // User can create many ATMReports
    public function CreatedAtmReports()
    {
        return $this->hasMany(ATMReport::class, 'created_by');
    }

    public function closedAtmReports()
    {
        return $this->hasMany(ATMReport::class, 'closed_by');

        // return $this->hasMany(ATMReport::class, 'closed_by')
        //     ->whereNotNull('close_date')        // only closed reports
        //     ->where('closed_by', auth()->id()); // only current user
    }




    // Similarly, for DataVPN
    public function dataVpns()
    {
        return $this->hasMany(DataVPN::class, 'created_by');
    }

    // And for FixedLine
    public function fixedLines()
    {
        return $this->hasMany(FixedLine::class, 'created_by');
    }


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
}


// $user = User::find(1);

// // All ATMReports created by this user
// $reports = $user->atmReports;
// // Access creator from a report
// $report = ATMReport::find(5);
// $creatorName = $report->creator->name;