<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'invoice-list',
            'invoice-create',
            'invoice-edit',
            'invoice-delete',
            'client-list',
            'client-create',
            'client-edit',
            'client-delete',
            'delivery-list',
            'delivery-create',
            'delivery-edit',
            'delivery-delete',
            'account-list',
            'account-create',
            'account-edit',
            'account-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'note-list',
            'note-create',
            'note-edit',
            'note-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
