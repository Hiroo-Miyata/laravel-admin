<?php

namespace Encore\Admin\Auth\Database;

use Illuminate\Database\Seeder;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a user.
        Administrator::truncate();
        Administrator::create([
            'email' => 'admin@example.com',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'name'     => 'Administrator',
            'status_div' => 1,
            'registered_administor_id' => 1,
            'registered_at' => '2019-03-01 00:00:00',
            'changed_administor_id' => 1,
            'changed_at' => '2019-03-01 00:00:00',
            'updated_id'  => '1'
        ]);

        // create a role.
        Role::truncate();
        Role::create([
            'name' => 'Administrator',
            'slug' => 'administrator',
        ]);

        // add role to user.
        Administrator::first()->roles()->save(Role::first());

        //create a permission
        Permission::truncate();
        Permission::insert([
            [
                'name'        => 'All permission',
                'slug'        => '*',
                'http_method' => '',
                'http_path'   => '*',
            ],
            [
                'name'        => 'Dashboard',
                'slug'        => 'dashboard',
                'http_method' => 'GET',
                'http_path'   => '/',
            ],
            [
                'name'        => 'Login',
                'slug'        => 'auth.login',
                'http_method' => '',
                'http_path'   => "/auth/login\r\n/auth/logout",
            ],
            [
                'name'        => 'User setting',
                'slug'        => 'auth.setting',
                'http_method' => 'GET,PUT',
                'http_path'   => '/auth/setting',
            ],
            [
                'name'        => 'Auth management',
                'slug'        => 'auth.management',
                'http_method' => '',
                'http_path'   => "/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs",
            ],
        ]);

        Role::first()->permissions()->save(Permission::first());

        // add default menus.
        Menu::truncate();
        Menu::insert([
            [
                'parent_id' => 0,
                'order'     => 1,
                'title'     => 'Index',
                'icon'      => 'fa-bar-chart',
                'uri'       => '/',
            ],
            [
                'parent_id' => 0,
                'order'     => 2,
                'title'     => 'Admin',
                'icon'      => 'fa-tasks',
                'uri'       => '',
            ],
            [
                'parent_id' => 2,
                'order'     => 3,
                'title'     => 'Users',
                'icon'      => 'fa-users',
                'uri'       => 'auth/users',
            ],
            [
                'parent_id' => 2,
                'order'     => 4,
                'title'     => 'Roles',
                'icon'      => 'fa-user',
                'uri'       => 'auth/roles',
            ],
            [
                'parent_id' => 2,
                'order'     => 5,
                'title'     => 'Permission',
                'icon'      => 'fa-ban',
                'uri'       => 'auth/permissions',
            ],
            [
                'parent_id' => 2,
                'order'     => 6,
                'title'     => 'Menu',
                'icon'      => 'fa-bars',
                'uri'       => 'auth/menu',
            ],
            [
                'parent_id' => 2,
                'order'     => 7,
                'title'     => 'Operation log',
                'icon'      => 'fa-history',
                'uri'       => 'auth/logs',
            ],
            [
                'parent_id' => 0,
                'order'     => 8,
                'title'     => '売り場',
                'icon'      => 'fa-history',
                'uri'       => 'departments',
            ],
            [
                'parent_id' => 0,
                'order'     => 9,
                'title'     => '商品',
                'icon'      => 'fa-history',
                'uri'       => 'items',
            ],
            [
                'parent_id' => 0,
                'order'     => 10,
                'title'     => '契約単価',
                'icon'      => 'fa-history',
                'uri'       => 'contract_prices',
            ],
            [
                'parent_id' => 0,
                'order'     => 11,
                'title'     => '通常価格',
                'icon'      => 'fa-history',
                'uri'       => 'standard_price',
            ],
            [
                'parent_id' => 0,
                'order'     => 12,
                'title'     => '顧客',
                'icon'      => 'fa-history',
                'uri'       => 'users',
            ],
            [
                'parent_id' => 0,
                'order'     => 13,
                'title'     => 'ポップ価格',
                'icon'      => 'fa-history',
                'uri'       => 'pop_prices',
            ],
            [
                'parent_id' => 0,
                'order'     => 14,
                'title'     => '注文履歴',
                'icon'      => 'fa-history',
                'uri'       => 'orders',
            ],
        ]);

        // add role to menu.
        Menu::find(2)->roles()->save(Role::first());
    }
}
