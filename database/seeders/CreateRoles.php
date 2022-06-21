<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('roles')->truncate();
        Schema::enableForeignKeyConstraints();

        $role = Role::create(['name' => 'superadmin']);

        Role::create(['name' => 'admin platinum', 'portfolio_id' => 1]);
        Role::create(['name' => 'account platinum', 'portfolio_id' => 1]);
        Role::create(['name' => 'logistic platinum', 'portfolio_id' => 1]);
        Role::create(['name' => 'clerk platinum', 'portfolio_id' => 1]);

        Role::create(['name' => 'admin dresella', 'portfolio_id' => 2]);
        Role::create(['name' => 'account dresella', 'portfolio_id' => 2]);
        Role::create(['name' => 'logistic dresella', 'portfolio_id' => 2]);
        Role::create(['name' => 'clerk dresella', 'portfolio_id' => 2]);

        Role::create(['name' => 'admin tck', 'portfolio_id' => 3]);
        Role::create(['name' => 'account tck', 'portfolio_id' => 3]);
        Role::create(['name' => 'logistic tck', 'portfolio_id' => 3]);
        Role::create(['name' => 'clerk tck', 'portfolio_id' => 3]);

        Role::create(['name' => 'admin agri', 'portfolio_id' => 4]);
        Role::create(['name' => 'account agri', 'portfolio_id' => 4]);
        Role::create(['name' => 'logistic agri', 'portfolio_id' => 4]);
        Role::create(['name' => 'clerk agri', 'portfolio_id' => 4]);

        Role::create(['name' => 'admin maryam', 'portfolio_id' => 5]);
        Role::create(['name' => 'account maryam', 'portfolio_id' => 5]);
        Role::create(['name' => 'logistic maryam', 'portfolio_id' => 5]);
        Role::create(['name' => 'clerk maryam', 'portfolio_id' => 5]);


        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);
    }
}
