<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Admin::factory()->count(10)->create();
        $this->call([
          //  AdminSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
        ]);

        $this->call([
            GlobalSettingSeeder::class,
        ]);
    }
}
