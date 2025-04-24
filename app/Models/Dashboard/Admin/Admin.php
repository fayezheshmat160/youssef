<?php

namespace App\Models\Dashboard\Admin;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    public $table = 'admins';
    public $timestamps = false;
    protected $fillable = [

        // Personal Data
        'id',
        'f_name',
        'l_name',
        'full_name',
        'email',
        'password',
        'phone',
        'about',
        'country',
        'city',
        'zip_code',
        'skills',
        'job',

        // Media
        'avatar',
        'cover',

        // Dashboard Settings For This Admin
        'language',
        'theme',

        // Other
        'last_seen',
        'email_verified_at',
        'status',
        'joining_date',
        'joining_date',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];
}
