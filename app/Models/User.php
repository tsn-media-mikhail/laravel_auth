<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;
    const PAGINATION = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function roles(){
        return $this->belongsToMany(Role::class, 'user_roles','user_id', 'role_id');
    }

    public function isAdmin(){
        return $this->roles()->where(['name'=> 'admin'])->exists();
    }

    public function isUser(){
        return $this->roles()->where(['name' =>  'user'])->exists();
    }

    public function isDisabled(){
        return $this->roles()->where(['name' => 'disabled'])->exists();
    }

    public static function getUsersByRequest(Request $request) {

        if (!empty($request['sort_by'])  && !empty($request['sort_type'])) {
            $sort_by = $request['sort_by'];
            $sort_type = $request['sort_type'];
        } else {
            $sort_by = 'id';
            $sort_type = 'desc';
        }

        $conditioins = [];

        if(!empty($request['s_id'])) {
            $conditioins['users.id'] = $request['s_id'];
        }

        if(!empty($request['s_name'])) {
            $conditioins[] = ['users.name', 'like', '%'. $request['s_name'].'%'];
        }

        if(!empty($request['s_email'])) {
            $conditioins[] = ['users.email', 'like', '%'. $request['s_email'].'%'];
        }

        if(!empty($request['s_roles'])) {
            $conditioins[] = ['roles.name', 'like', '%'. $request['s_roles'].'%'];
        }

        $users = User::select(['users.*', DB::raw('GROUP_CONCAT(roles.name) as roles')])
            ->leftJoin('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->leftJoin('roles', 'roles.id', '=', 'user_roles.role_id')
            ->where($conditioins)
            ->groupBy('users.id')
            ->orderBy($sort_by, $sort_type)
            ->paginate(USER::PAGINATION);

        return $users;
    }
}
