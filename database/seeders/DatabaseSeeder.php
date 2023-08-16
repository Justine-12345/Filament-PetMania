<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::factory(1)->create();
        \App\Models\User::factory(1)->create();

        $permissions = [
            'Animal View',
            'Animal Create',
            'Animal Update',
            'Animal Delete',
            'Animal Restore',
            'Animal Force Delete',
            'Category View',
            'Category Create',
            'Category Update',
            'Category Delete',
            'Category Restore',
            'Category Force Delete',
            'Disease View',
            'Disease Create',
            'Disease Update',
            'Disease Delete',
            'Disease Restore',
            'Disease Force Delete',
            'Permission View',
            'Permission Create',
            'Permission Update',
            'Permission Delete',
            'Permission Restore',
            'Permission Force Delete',
            'Role View',
            'Role Create',
            'Role Update',
            'Role Delete',
            'Role Restore',
            'Role Force Delete',
            'User View',
            'User Create',
            'User Update',
            'User Delete',
            'User Restore',
            'User Force Delete',
        ];
        
        foreach ($permissions as $permission) {
             \App\Models\Permission::factory()->create([
            'name' => $permission,
        ]);
        }
        
       

        
    }
}
