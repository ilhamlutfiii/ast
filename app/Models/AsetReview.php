<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsetReview extends Model
{
    protected $fillable=['user_id','aset_id','pinjam_id','rate','review','status'];

    public function user_info(){
        return $this->hasOne('App\User','id','user_id');
    }

    public static function getAllReview(){
        return AsetReview::with('user_info')->paginate(10);
    }
    public static function getAllUserReview(){
        return AsetReview::where('user_id',auth()->user()->id)->with('user_info')->paginate(10);
    }

    public function Aset(){
        return $this->hasOne(Aset::class,'id','aset_id');
    }
    public function pinjam()
    {
        return $this->belongsTo(Pinjam::class, 'pinjam_id');
    }

}
