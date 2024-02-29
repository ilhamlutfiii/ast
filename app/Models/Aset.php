<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
class Aset extends Model
{
    protected $fillable=['title','slug','summary','description','cat_id','child_cat_id','status','photo','stock','is_featured','condition'];

    public function cat_info(){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }
    public function sub_cat_info(){
        return $this->hasOne('App\Models\Category','id','child_cat_id');
    }
    public static function getAllAset(){
        return Aset::with(['cat_info','sub_cat_info'])->orderBy('id','desc')->paginate(10);
    }
    public function rel_prods(){
        return $this->hasMany('App\Models\Aset','cat_id','cat_id')->where('status','active')->orderBy('id','DESC')->limit(8);
    }
    public function reviews()
    {
        return $this->hasMany(  AsetReview::class);
    }
    public function getReview(){
        return $this->hasMany('App\Models\AsetReview','aset_id','id')->with('user_info')->where('status','active')->orderBy('id','DESC');
    }
    public static function getAsetBySlug($slug){
        return Aset::with(['cat_info','rel_prods','getReview'])->where('slug',$slug)->first();
    }
    public static function countActiveAset(){
        $data=Aset::where('status','active')->count();
        if($data){
            return $data;
        }
        return 0;
    }

    public function carts(){
        return $this->hasMany(Cart::class)->whereNotNull('order_id');
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class)->whereNotNull('cart_id');
    }
    public function pinjams(){
        return $this->hasMany('App\Models\Pinjam');
    }

    public function maintenances()
    {
        return $this->hasMany('App\Models\Maintenance');
    }

}
