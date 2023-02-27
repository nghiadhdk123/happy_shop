<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'fb_id',
        'gg_id',
        'github_id',
        'auth_type',
        'name',
        'email',
        'password',
        'phone',
        'address',
        'gender',
        'role',
        'is_active',
        'user_update',
        'path',
        'avatar',
        'avatar_url',
        'active',
        'time_login',
        'created_at',
        'updated_at',
    ];

    const NAM = 0;
    const NU = 1;
    const KHAC = 2;

    const USER = 0;
    const STAFF = 1;
    const ADMIN = 2;

    const Active = 1;
    const Unactive = 0;

    public static $gender_text=[
        self::NAM => "NAM",
        self::NU => "NỮ",
        self::KHAC => "KHÁC",
    ];

    public function getGenderTextAttribute()
    {
        return self::$gender_text[$this->gender];
    }

    public static $role_text=[
        self::USER => "Người dùng",
        self::STAFF => "Nhân Viên",
        self::ADMIN => "Admin",
    ];

    public function getRoleTextAttribute()
    {
        return self::$role_text[$this->role];
    }

    public static $status_text=[
        self::Active => "Hoạt động",
        self::Unactive => "Ngừng hoạt động",
    ];

    public function getStatusTextAttribute()
    {
        return self::$status_text[$this->is_active];
    }

    public function userInfor(){
        return $this->hasOne(UserInfor::class);
    }

    public function votePosts()
    {
        return $this->belongsToMany(Post::class,'likes');
    }

    public function haveVouchers()
    {
        return $this->belongsToMany(Voucher::class,'user_voucher')->withPivot(['status']);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    const SLEEP = "fas fa-bed";
    const READ = "fas fa-book";

    public static $hobby_text=[
        self::SLEEP => "Ngủ",
        self::READ => "Đọc sách",
    ];
}
