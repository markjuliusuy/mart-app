<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as Carbon;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                PermissionSeeder::class,
                RoleSeeder::class,
                CategorySeeder::class,
                DiscountSeeder::class,
                ProductSeeder::class,
            ]
        );
        $user = User::create(
            [
                'name' => 'Mark Julius Uy',
                'username' => 'admin',
                'email' => 'markjuliusuy@gmail.com',
                'password' => bcrypt('admin')
            ]
        );

        $user->assignRole('admin');

    }
}
