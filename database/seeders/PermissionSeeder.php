<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dashboard
        $module = Module::updateOrCreate(['name' => 'Dashboard'], ['name' => 'Dashboard']);
        Permission::updateOrCreate(['slug' => 'dashboard-access'], [
            'module_id' => $module->id,
            'name' => 'Dashbaord Access',
            'slug' => 'dashboard-access',
        ]);

        // Page
        $module = Module::updateOrCreate(['name' => 'Page'], ['name' => 'Page']);
        Permission::updateOrCreate(['slug' => 'page-access'], [
            'module_id' => $module->id,
            'name' => 'Page Access',
            'slug' => 'page-access',
        ]);
        Permission::updateOrCreate(['slug' => 'page-store'], [
            'module_id' => $module->id,
            'name' => 'Page Store',
            'slug' => 'page-store',
        ]);
        Permission::updateOrCreate(['slug' => 'page-edit'], [
            'module_id' => $module->id,
            'name' => 'Page Edit',
            'slug' => 'page-edit',
        ]);
        Permission::updateOrCreate(['slug' => 'page-delete'], [
            'module_id' => $module->id,
            'name' => 'Page Delete',
            'slug' => 'page-delete',
        ]);


        // Menu
        $module = Module::updateOrCreate(['name' => 'Menu'], ['name' => 'Menu']);
        Permission::updateOrCreate(['slug' => 'menu-access'], [
            'module_id' => $module->id,
            'name' => 'Menu Access',
            'slug' => 'menu-access',
        ]);
        Permission::updateOrCreate(['slug' => 'menu-store'], [
            'module_id' => $module->id,
            'name' => 'Menu Store',
            'slug' => 'menu-store',
        ]);
        Permission::updateOrCreate(['slug' => 'menu-edit'], [
            'module_id' => $module->id,
            'name' => 'Menu Edit',
            'slug' => 'menu-edit',
        ]);
        Permission::updateOrCreate(['slug' => 'menu-delete'], [
            'module_id' => $module->id,
            'name' => 'Menu Delete',
            'slug' => 'menu-delete',
        ]);

        // Home Section
        $module = Module::updateOrCreate(['name' => 'Home Section'], ['name' => 'Home Section']);
        Permission::updateOrCreate(['slug' => 'home-section-access'], [
            'module_id' => $module->id,
            'name' => 'Home Section Access',
            'slug' => 'home-section-access',
        ]);


        // Testimonial
        $module = Module::updateOrCreate(['name' => 'Testimonial'], ['name' => 'Testimonial']);
        Permission::updateOrCreate(['slug' => 'testimonial-access'], [
            'module_id' => $module->id,
            'name' => 'Testimonial Access',
            'slug' => 'testimonial-access',
        ]);
        Permission::updateOrCreate(['slug' => 'testimonial-store'], [
            'module_id' => $module->id,
            'name' => 'Testimonial Store',
            'slug' => 'testimonial-store',
        ]);
        Permission::updateOrCreate(['slug' => 'testimonial-edit'], [
            'module_id' => $module->id,
            'name' => 'Testimonial Edit',
            'slug' => 'testimonial-edit',
        ]);
        Permission::updateOrCreate(['slug' => 'testimonial-delete'], [
            'module_id' => $module->id,
            'name' => 'Testimonial Delete',
            'slug' => 'testimonial-delete',
        ]);


        //Appearance
        $module = Module::updateOrCreate(['name' => 'Appearance'], ['name' => 'Appearance']);
        Permission::updateOrCreate(['slug' => 'theme-setting-access'], [
            'module_id' => $module->id,
            'name' => 'Theme Setting Access',
            'slug' => 'theme-setting-access',
        ]);

        // Service
        $module = Module::updateOrCreate(['name' => 'Faq Service'], ['name' => 'Faq Service']);
        Permission::updateOrCreate(['slug' => 'faq-service-access'], [
            'module_id' => $module->id,
            'name' => 'Faq Service Access',
            'slug' => 'faq-service-access',
        ]);
        Permission::updateOrCreate(['slug' => 'faq-service-store'], [
            'module_id' => $module->id,
            'name' => 'Faq Service Store',
            'slug' => 'faq-service-store',
        ]);
        Permission::updateOrCreate(['slug' => 'faq-service-edit'], [
            'module_id' => $module->id,
            'name' => 'Faq Service Edit',
            'slug' => 'faq-service-edit',
        ]);
        Permission::updateOrCreate(['slug' => 'faq-service-delete'], [
            'module_id' => $module->id,
            'name' => 'Faq Service Delete',
            'slug' => 'faq-service-delete',
        ]);

        // Question
        $module = Module::updateOrCreate(['name' => 'Faq Question'], ['name' => 'Faq Question']);
        Permission::updateOrCreate(['slug' => 'faq-question-access'], [
            'module_id' => $module->id,
            'name' => 'Faq Question Access',
            'slug' => 'faq-question-access',
        ]);
        Permission::updateOrCreate(['slug' => 'faq-question-store'], [
            'module_id' => $module->id,
            'name' => 'Faq Question Store',
            'slug' => 'faq-question-store',
        ]);
        Permission::updateOrCreate(['slug' => 'faq-question-edit'], [
            'module_id' => $module->id,
            'name' => 'Faq Question Edit',
            'slug' => 'faq-question-edit',
        ]);
        Permission::updateOrCreate(['slug' => 'faq-question-delete'], [
            'module_id' => $module->id,
            'name' => 'Faq Question Delete',
            'slug' => 'faq-question-delete',
        ]);

        // Blog Category
        $module = Module::updateOrCreate(['name' => 'Blog Category'], ['name' => 'Blog Category']);
        Permission::updateOrCreate(['slug' => 'blog-category-access'], [
            'module_id' => $module->id,
            'name' => 'Blog Category Access',
            'slug' => 'blog-category-access',
        ]);
        Permission::updateOrCreate(['slug' => 'blog-category-store'], [
            'module_id' => $module->id,
            'name' => 'Blog Category Store',
            'slug' => 'blog-category-store',
        ]);
        Permission::updateOrCreate(['slug' => 'blog-category-edit'], [
            'module_id' => $module->id,
            'name' => 'Blog Category Edit',
            'slug' => 'blog-category-edit',
        ]);
        Permission::updateOrCreate(['slug' => 'blog-category-delete'], [
            'module_id' => $module->id,
            'name' => 'Blog Category Delete',
            'slug' => 'blog-category-delete',
        ]);

        // Blog Post
        $module = Module::updateOrCreate(['name' => 'Blog Post'], ['name' => 'Blog Post']);
        Permission::updateOrCreate(['slug' => 'blog-post-access'], [
            'module_id' => $module->id,
            'name' => 'Blog Post Access',
            'slug' => 'blog-post-access',
        ]);
        Permission::updateOrCreate(['slug' => 'blog-post-store'], [
            'module_id' => $module->id,
            'name' => 'Blog Post Store',
            'slug' => 'blog-post-store',
        ]);
        Permission::updateOrCreate(['slug' => 'blog-post-edit'], [
            'module_id' => $module->id,
            'name' => 'Blog Post Edit',
            'slug' => 'blog-post-edit',
        ]);
        Permission::updateOrCreate(['slug' => 'blog-post-delete'], [
            'module_id' => $module->id,
            'name' => 'Blog Post Delete',
            'slug' => 'blog-post-delete',
        ]);

        // User
        $module = Module::updateOrCreate(['name' => 'User'], ['name' => 'User']);
        Permission::updateOrCreate(['slug' => 'user-access'], [
            'module_id' => $module->id,
            'name' => 'User Access',
            'slug' => 'user-access',
        ]);
        Permission::updateOrCreate(['slug' => 'user-store'], [
            'module_id' => $module->id,
            'name' => 'User Store',
            'slug' => 'user-store',
        ]);
        Permission::updateOrCreate(['slug' => 'user-edit'], [
            'module_id' => $module->id,
            'name' => 'User Edit',
            'slug' => 'user-edit',
        ]);
        Permission::updateOrCreate(['slug' => 'user-delete'], [
            'module_id' => $module->id,
            'name' => 'User Delete',
            'slug' => 'user-delete',
        ]);


        // Permission
        $module = Module::updateOrCreate(['name' => 'Permission'], ['name' => 'Permission']);
        Permission::updateOrCreate(['slug' => 'permission-access'], [
            'module_id' => $module->id,
            'name' => 'Permission Access',
            'slug' => 'permission-access',
        ]);
        Permission::updateOrCreate(['slug' => 'permission-store'], [
            'module_id' => $module->id,
            'name' => 'Permission Store',
            'slug' => 'permission-store',
        ]);
        Permission::updateOrCreate(['slug' => 'permission-edit'], [
            'module_id' => $module->id,
            'name' => 'Permission Edit',
            'slug' => 'permission-edit',
        ]);
        Permission::updateOrCreate(['slug' => 'permission-delete'], [
            'module_id' => $module->id,
            'name' => 'Permission Delete',
            'slug' => 'permission-delete',
        ]);

        // Role
        $module = Module::updateOrCreate(['name' => 'Role'], ['name' => 'Role']);
        Permission::updateOrCreate(['slug' => 'role-access'], [
            'module_id' => $module->id,
            'name' => 'Role Access',
            'slug' => 'role-access',
        ]);
        Permission::updateOrCreate(['slug' => 'role-store'], [
            'module_id' => $module->id,
            'name' => 'Role Store',
            'slug' => 'role-store',
        ]);
        Permission::updateOrCreate(['slug' => 'role-edit'], [
            'module_id' => $module->id,
            'name' => 'Role Edit',
            'slug' => 'role-edit',
        ]);
        Permission::updateOrCreate(['slug' => 'role-delete'], [
            'module_id' => $module->id,
            'name' => 'Role Delete',
            'slug' => 'role-delete',
        ]);

        // Settings
        $module = Module::updateOrCreate(['name' => 'Settings'], ['name' => 'Settings']);
        Permission::updateOrCreate(['slug' => 'mail-access'], [
            'module_id' => $module->id,
            'name' => 'Mail Access',
            'slug' => 'mail-access',
        ]);

        // Settings
        $module = Module::updateOrCreate(['name' => 'Subscribe'], ['name' => 'Subscribe']);
        Permission::updateOrCreate(['slug' => 'subscribe-access'], [
            'module_id' => $module->id,
            'name' => 'Subscribe Access',
            'slug' => 'subscribe-access',
        ]);
        Permission::updateOrCreate(['slug' => 'subscribe-edit'], [
            'module_id' => $module->id,
            'name' => 'Subscribe Edit',
            'slug' => 'subscribe-edit',
        ]);
    }
}
