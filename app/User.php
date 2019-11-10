<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'lname', 'fname', 'address', 'phone', 'field',
        'mname','dept_id', 'password', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function department() {
        return $this->belongsTo('App\Department','dept_id');
    }

    public function roles() {
        return $this->hasMany('App\Role');
    }

    public static function getTeachers() {
        return static::whereHas('roles', function($query){
            $query->whereRaw('role_id IN (SELECT id FROM roles WHERE name="teacher")');
        });
    }

    public static function getTeachersForList() {
        $roleId = DB::table('roles')->select('id')
            ->where('name','teacher')->pluck('id')->first();

        return DB::table('users')
            ->selectRaw('CONCAT(lname,", ",fname) AS name, id')
            ->whereRaw("id IN (SELECT user_id FROM role_user WHERE role_id=$roleId)")
            ->orderBy('lname')
            ->orderBy('fname')
            ->pluck('name','id');
    }

    public function getFullNameAttribute() {
        return $this->lname . ', ' . $this->fname;
    }

    public function hasRole($role) {
        $r = Role::where('user_id', $this->id)->where('role', $role)->first();
        return $r!=null;
    }
}
