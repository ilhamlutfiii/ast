<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Pinjam extends Model
{
    protected $fillable = ['user_id', 'aset_id', 'pinjam_number', 'sub_total', 'quantity', 'status', 'rv'];

    public function cart_info()
    {
        return $this->hasMany('App\Models\Cart', 'pinjam_id', 'id');
    }
    public static function getAllpinjam($id)
    {
        return pinjam::with('cart_info')->find($id);
    }
    public static function countActivepinjam()
    {
        $data = pinjam::count();
        if ($data) {
            return $data;
        }
        return 0;
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id');
    }
    public function asetReview()
    {
        return $this->hasOne(AsetReview::class);
    }
    public function getReview()
    {
        return $this->hasMany('App\Models\AsetReview', 'aset_id', 'id')->with('user_info')->where('status', 'active')->orderBy('id', 'DESC');
    }
}
