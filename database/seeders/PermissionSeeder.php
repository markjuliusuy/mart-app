<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'add categories',
            'edit categories',
            'view categories',
            'delete categories',

            'add brands',
            'edit brands',
            'view brands',
            'delete brands',

            'add products',
            'edit products',
            'view products',
            'delete products',

            'add discounts',
            'edit discounts',
            'view discounts',
            'delete discounts',

            'add customers',
            'edit customers',
            'view customers',
            'delete customers',

            'add suppliers',
            'edit suppliers',
            'view suppliers',
            'delete suppliers',

            'add inventories',
            'edit inventories',
            'view inventories',
            'delete inventories',

            'add users',
            'edit users',
            'view users',
            'delete users',

            'add sales',
            'edit sales',
            'view sales',
            'delete sales',
        ];

        foreach($permissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }

    }
}
