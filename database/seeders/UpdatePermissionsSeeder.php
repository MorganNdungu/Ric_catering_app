<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Database\Seeders\UpdatePermissionsSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UpdatePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $permissions = [
       
        'view-items',    // Updated permission name
        'item-create',
        'item-edit',
        'delete-items',  // New permission
    ];

    foreach ($permissions as $permission) {
        Permission::updateOrCreate(['name' => $permission]);
    }
}

}
