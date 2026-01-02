<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use id;
use Filament\Panel;
use App\Models\DataVPN;
use App\Models\ATMReport;
use App\Models\FixedLine;
use App\Models\UserGroup;
use Filament\Models\Contracts\HasName;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Auth\MultiFactor\Email\Contracts\HasEmailAuthentication;



//class User extends Authenticatable implements FilamentUser

class User extends Authenticatable


//class User extends Authenticatable implements FilamentUser, HasEmailAuthentication, MustVerifyEmail
{



    //implements FilamentUser

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    const ROLE_ADMIN = 'admin';
    const ROLE_BRANCH = 'branch';
    const ROLE_HEAD = 'head'; // example limited user
    const ROLE_STOCKER = 'stocker'; // example limited user

    protected $fillable = [
        'name',            // optional if you generate full name
        'fname',
        'mname',
        'lname',
        'email',
        'phone',
        'address',
        'branch_id',
        'isActive',
        'role',
        'has_email_authentication',
        'email_verified_at',
        'password',
    ];

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isBranch(): bool
    {
        return $this->role === self::ROLE_BRANCH;
    }

    public function isHead(): bool
    {
        return $this->role === self::ROLE_HEAD;
    }
    public function isStocker(): bool
    {
        return $this->role === self::ROLE_STOCKER;
    }

    // ...

    // public function hasEmailAuthentication(): bool
    // {
    //     // This method should return true if the user has enabled email authentication.

    //     return $this->has_email_authentication;
    // }

    // public function toggleEmailAuthentication(bool $condition): void
    // {
    //     // This method should save whether or not the user has enabled email authentication.

    //     $this->has_email_authentication = $condition;
    //     $this->save();
    // }


    // ...

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }


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
            'has_email_authentication' => 'boolean',
        ];
    }


    //     public function userGroups()
    //     {
    //         return $this->belongsToMany(UserGroup::class, 'user_user_group');
    //     }
    // }

    // public function userGroups()
    // {
    //     return $this->belongsToMany(UserGroup::class);
    // }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // public function group()
    // {
    //     return $this->belongsTo(UserGroup::class);
    // }

    // public function hasPermission(string $permissionName): bool
    // {
    //     return $this->group?->permissions?->contains('name', $permissionName) ?? false;
    // }


    public function userGroups()
    {
        return $this->belongsToMany(UserGroup::class, 'user_user_group', 'user_id', 'user_group_id')
            ->using(UserUserGroup::class)
            ->withTimestamps();
    }


    // public function groups()
    // {
    //     return $this->belongsToMany(UserGroup::class, 'user_user_group')
    //         ->using(UserUserGroup::class);
    // }
}


// $user = User::find(1);

// // All ATMReports created by this user
// $reports = $user->atmReports;
// // Access creator from a report
// $report = ATMReport::find(5);
// $creatorName = $report->creator->name;