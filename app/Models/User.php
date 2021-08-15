<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'active',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the user details associated with the user.
     */
    public function detail()
    {
        return $this->hasOne(UserDetail::class);
    }
}
