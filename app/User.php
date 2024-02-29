<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'userss';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_nid', 'user_nama', 'jabatan_id', 'bidang_id', 'fungsi_id', 'password', 'photo', 'role', 'status',
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

    public function pinjams(){
        return $this->hasMany('App\Models\Pinjam', 'user_id', 'id');
    }
    public function jabatans()
    {
        return $this->belongsTo('App\Models\Jabatan', 'jabatan_id');
    }
    public function bidangs()
    {
        return $this->belongsTo('App\Models\Bidang', 'bidang_id');
    }
    public function fungsis()
    {
        return $this->belongsTo('App\Models\Fungsi', 'fungsi_id');
    }
}
