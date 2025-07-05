<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Role Create
        $permission_all = Permission::all();
        $super = Role::updateOrCreate(['name' => 'Super'],[
            'name' => 'Super',
            'slug' => 'super',
        ]);
        $admin = Role::updateOrCreate(['name' => 'Admin'],[
            'name' => 'Admin',
            'slug' => 'admin',
        ]);
        $accountent = Role::updateOrCreate(['name' => 'Accountent'],[
            'name' => 'Accountent',
            'slug' => 'accountent',
        ]);
        $project_manager = Role::updateOrCreate(['name' => 'Project Manager'],[
            'name' => 'Project Manager',
            'slug' => 'project_manager',
        ]);
        $product_manager = Role::updateOrCreate(['name' => 'Product Manager'],[
            'name' => 'Product Manager',
            'slug' => 'product_manager',
        ]);
        $selles_manager = Role::updateOrCreate(['name' => 'Selles Manager'],[
            'name' => 'Selles Manager',
            'slug' => 'selles_manager',
        ]);
        $purchase_manager = Role::updateOrCreate(['name' => 'Purchase Manager'],[
            'name' => 'Purchase Manager',
            'slug' => 'purchase_manager',
        ]);
        $client_portal = Role::updateOrCreate(['name' => 'Client Portal'],[
            'name' => 'Client Portal',
            'slug' => 'client_portal',
        ]);

        // Super Admin Create
        User::updateOrCreate(['email' => 'super@gmail.com'],[
            'role_id'           => $super->id,
            'fname'             => 'Mr.',
            'lname'             => 'Super',
            'phone'             => '01909758921',
            'email'             => 'super@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make(12345678),
            'avater'            => null,
        ]);

        // Admin Create
        User::updateOrCreate(['email' => 'admin@gmail.com'],[
            'role_id'           => $admin->id,
            'fname'             => 'Mr.',
            'lname'             => 'Admin',
            'phone'             => '01909758922',
            'email'             => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make(12345678),
            'avater'            => null,
        ]);

        // Accountent Create
        User::updateOrCreate(['email' => 'accountent@gmail.com'],[
            'role_id'           => $accountent->id,
            'fname'             => 'Mr.',
            'lname'             => 'Accountent',
            'phone'             => '01909758923',
            'email'             => 'accountent@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make(12345678),
            'avater'            => null,
        ]);

        // Project Manager Create
        User::updateOrCreate(['email' => 'projectmanager@gmail.com'],[
            'role_id'           => $project_manager->id,
            'fname'             => 'Mr.',
            'lname'             => 'Project Manager',
            'phone'             => '01909758924',
            'email'             => 'projectmanager@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make(12345678),
            'avater'            => null,
        ]);

        // Product Manager Create
        User::updateOrCreate(['email' => 'productmanager@gmail.com'],[
            'role_id'           => $product_manager->id,
            'fname'             => 'Mr.',
            'lname'             => 'Product Manager',
            'phone'             => '01909758925',
            'email'             => 'productmanager@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make(12345678),
            'avater'            => null,
        ]);

        // Selles Manager Create
        User::updateOrCreate(['email' => 'sellesmanager@gmail.com'],[
            'role_id'           => $selles_manager->id,
            'fname'             => 'Mr.',
            'lname'             => 'Selles Manager',
            'phone'             => '01909758926',
            'email'             => 'sellesmanager@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make(12345678),
            'avater'            => null,
        ]);

        // Purchase Manager Create
        User::updateOrCreate(['email' => 'purchasemanager@gmail.com'],[
            'role_id'           => $purchase_manager->id,
            'fname'             => 'Mr.',
            'lname'             => 'Purchase Manager',
            'phone'             => '01909758927',
            'email'             => 'purchasemanager@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make(12345678),
            'avater'            => null,
        ]);

        // Purchase Manager Create
        User::updateOrCreate(['email' => 'clientportal@gmail.com'],[
            'role_id'           => $client_portal->id,
            'fname'             => 'Mr.',
            'lname'             => 'Client Portal',
            'phone'             => '01909758928',
            'email'             => 'clientportal@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make(12345678),
            'avater'            => null,
        ]);
    }
}
