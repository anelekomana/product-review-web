<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Role;
use App\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create admin && customer role
        $adminRole = Role::create([
            'name' => 'admin'
        ]);
        $customerRole = Role::create([
            'name' => 'customer'
        ]);

        //Create admin role
        $createProduct = Permission::create([
            'name' => 'create-product',
        ]);

        //Attach role to admin
        $adminRole->attachPermission($createProduct);

        //Create admin & customer
        $admin =  User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        $customer =  User::create([
            'name' => 'customer',
            'email' => 'customer@customer.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        //Attach admin & customer role
        $admin->attachRole($adminRole);
        $customer->attachRole($customerRole);
    }
}
