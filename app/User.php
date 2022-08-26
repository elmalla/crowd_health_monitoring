<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'braclet_id', 'national_id', 'country', 'email', 'phone', 'mobile_id',  'name', 'password', 'nationality', 'gender', 'birth_date', 'is_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function BraceletTracker()
    {
        return $this->hasMany(BraceletTracker::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function clientSupervisor()
    {
        return $this->hasMany(ClientSupervisor::class, 'user_id', 'id');
    }

    public function clientEmployees()
    {
        return $this->hasMany(ClientEmployees::class, 'user_id', 'id');
    }

    public function braceletEmployees()
    {
        return $this->hasMany(BraceletEmployees::class);
    }

    public function isPTAdmin()
    {
        $rolePTAdmin = Role::find(1)->id;
        $userrole = Auth::user()->role()->first()->id;
        if ($userrole == $rolePTAdmin) {
            return true;
        }
        return false;
    }

    public function isClientSupervisor()
    {
        $roleClientSupervisor = Role::find(2)->id;
        $userrole = Auth::user()->role()->first()->id;
        if ($userrole == $roleClientSupervisor) {
            return true;
        }
        return false;
    }

    public function isClientEmployee()
    {
        $roleClientEmployee = Role::find(3)->id;
        $userrole = Auth::user()->role()->first()->id;
        if ($userrole == $roleClientEmployee) {
            return true;
        }
        return false;
    }
}
