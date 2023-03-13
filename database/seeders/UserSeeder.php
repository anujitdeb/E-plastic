<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default credentials
//        User::insert([
//            [
//                'name' => 'Left4code',
//                'email' => 'midone@left4code.com',
//                'email_verified_at' => now(),
//                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
//                'remember_token' => Str::random(10)
//            ]
//        ]);
      $admin=  Admin::create([
            'name'=>'Super Admin',
            'email'=>'super@admin.com',
            'username'=>'superadmin',
            'password'=>bcrypt('12345678'),
        ]);
        $admin->assignRole('superadmin');

        // Fake users
//        User::factory()->times(9)->create();
    }
}
