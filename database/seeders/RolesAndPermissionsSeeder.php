<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            // users and system
            'manage users', 
            
            // publishing houses
            'create publishing house',
            'manage publishing house',
            'manage publishing staff',
            
            // books
            'create book',
            'edit own book',
            'submit book for publishing',
            
            // publishing workflow
            'review publishing request',
            'approve publishing request',
            'reject publishing request',
            
            // library
            'browse library'
        ];
        foreach($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $publisher = Role::firstOrCreate(['name' => 'Publisher']);
        $author = Role::firstOrCreate(['name' => 'Author']);
        $reader = Role::firstOrCreate(['name' => 'Reader']);
        
        $admin->givePermissionTo(Permission::all());

        $publisher->givePermissionTo([
            'manage publishing house',
            'manage publishing staff',
            'review publishing request',
            'approve publishing request',
            'reject publishing request',
        ]);

        $author->givePermissionTo([
            'create book',
            'edit own book',
            'submit book for publishing',
        ]);

        $reader->givePermissionTo([
            'browse library',
        ]);

    }
}
