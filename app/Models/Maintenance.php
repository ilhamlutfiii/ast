<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    
    protected $fillable = [
        'maintenance_nama', 'id'
    ];

    public function asets()
    {
        return $this->hasMany('App\Models\Aset', 'id');
    }

}
