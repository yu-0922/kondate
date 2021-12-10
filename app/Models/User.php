<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable
{
    use Notifiable;

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

    /**
     * ユーザーが作成したメニューを取得
     */
    public function menus() {
        return $this->hasMany('App\Models\Menu');
    }

    /**
     * ユーザーの献立を取得
     */
    public function recipes() {
        return $this->hasMany('App\Models\Recipe');
    }

    /**
     * ユーザーの買い物リストを取得
     */
    public function shoppingLists() {
        return $this->hasMany('App\Models\ShoppingList');
    }
}
