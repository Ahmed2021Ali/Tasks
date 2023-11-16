<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Report;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();
        $users = [
            ['name' => 'Ahmed','email'=> 'ahmed@gmail.com','password'=>Hash::make('123456789'),'phone'=> '201017786080','role'=>'admin'],
            ['name' => 'Mohamed','email'=> 'mohamed@gmail.com','password'=>Hash::make('123456789'),'phone'=> '201017786080','role'=>'admin'],
            ['name' => 'Kaled','email'=> 'kaled@gmail.com','password'=>Hash::make('123456789'),'phone'=> '201017786080','role'=>'admin'],
        ];
        foreach ($users as $user)
        {
           $user= User::create($user);
           Report::create([
            'user_id'=>$user->id,
           ]);
        }
    }
}
