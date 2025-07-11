<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'is_rator',
        'education'
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

    public function canAccessPanel(Panel $panel): bool
    {
        switch ($panel->getId()) {
            case 'admin':
                if ($this->is_admin || $this->is_rator) {
                    return true; // Masuk ke panel admin
                } else {
                    return false; // Tidak memenuhi syarat untuk panel admin
                }
                break;
            default:
                if ($this->is_admin || $this->is_rator) {
                    return false; // Masuk ke panel admin
                } else {
                    return true; // Tidak memenuhi syarat untuk panel admin
                }
                break;
        }
    }

    public function isAdmin(): bool
    {
        return $this->is_admin === true;
    }
}
