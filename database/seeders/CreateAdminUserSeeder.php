<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Product;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_list = Permission::create(['name' => 'product-list']);
        $product_create = Permission::create(['name' => 'product-create']);
        $product_edit = Permission::create(['name' => 'product-edit']);
        $product_delete = Permission::create(['name' => 'product-delete']);
      
        $admin_role = Role::create(['name' => 'Admin']);

        // $admin_role->givePermissionTo([
        //     $product_list,
        //     $product_create,
        //     $product_edit,
        //     $product_delete
        // ]);

        $admin = User::create([
            'name' => 'Tahseen Raza', 
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $admin->assignRole($admin_role);
        $admin->givePermissionTo([
            $product_list,
            $product_create,
            $product_edit,
            $product_delete
        ]);

        $user = User::create([
            'name' => 'User For Testing', 
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $user_role = Role::create(['name' => 'User']);

        $user->assignRole($user_role);
        $user->givePermissionTo([
            $product_list
        ]);

        Product::create([
            'name' => 'product name',
            'detail' => 'test product detail product-list',
        ]);

        Product::create([
            'name' => 'product name 2',
            'detail' => 'test product detail product-list 2',
        ]);

        Product::create([
            'name' => 'product name 3',
            'detail' => 'test product detail product-list 3',
        ]);
        
    }
}
