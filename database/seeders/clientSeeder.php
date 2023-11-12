<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class clientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clients')->delete();
        $users = [
            ['name' => 'Peter','phone'=> '201017786080'],
            ['name' => 'tarek','phone'=> '201017786080'],

        ];
        foreach ($users as $user) {
            Client::create($user);
        }
    }
}
