<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserssTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $data=array(
            array(
                'user_nid'=>'123456789zjy',
                'user_nama'=>'Admin',
                'jabatan_id'=>'1',
                'bidang_id'=>'1',
                'fungsi_id'=>'1',
                'password'=>Hash::make('123456789zjy'),
                'photo'=>'',
                'role'=>'admin',
                'status'=>'active'
            ),
            array(
                'user_nid'=>'987654321zjy',
                'user_nama'=>'User',
                'jabatan_id'=>'1',
                'bidang_id'=>'1',
                'fungsi_id'=>'1',
                'password'=>Hash::make('987654321zjy'),
                'photo'=>'',
                'role'=>'User',
                'status'=>'active'
            ),
        );
    
        DB::table('userss')->insert($data);
        
    }
}
