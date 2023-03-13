<?php

namespace App\Main;

use Illuminate\Http\Request;

class SideMenu
{
    /**
     * List of side menu items.
     *
     * @param Request $request
     * @return array
     */
    public static function menu()
    {
        return [
            'dashboard' => [
                'permission' => 'dashboard',
                'guard' => ['admin'],
                'icon' => 'home',
                'title' => 'Dashboard',
                'route_name' => 'dashboard.index',
                'params' => [

                ],

            ],
           'role' => [
                'permission' => 'role.view',
                'icon' => 'user',
                'guard' => ['admin'],
                'title' => 'Roles',
                'route_name' => 'dashboard.role.index',
                'params' => [

                ],

            ],
            'admin' => [
                'permission' => 'admin.view',
                'icon' => 'user',
                'guard' => ['admin'],
                'title' => 'Admins',
                'route_name' => 'dashboard.admin.index',
                'params' => [

                ],

            ],
            'settings' => [
                'permission' => 'setting.view',
                'guard' =>[ 'admin'],
                'icon' => 'user',
                'title' => 'Settings',
                'route_name' => 'dashboard.global-settings.index',
                'params' => [

                ],

            ],
            //end of for admin
            //begin for organizer

           /* 'organizer_dashboard' => [
                'permission' => 'dashboard',
                'icon' => 'tool',
                'guard' => ['organizer'],
                'title' => 'Dashboard',
                'route_name' => 'organizer.dashboard',
                'params' => [

                ],

            ],
            'fair' => [
                'permission' => 'dashboard',
                'icon' => 'tool',
                'guard' => ['organizer'],
                'title' => 'Manage Book Fairs',
                'route_name' => 'organizer.fair.index',
                'params' => [

                ],

            ],

            'bookstall' => [
                'permission' => 'dashboard',
                'icon' => 'home',
                'guard' =>[ 'stall'],
                'title' => 'Dashboard',
                'route_name' => 'stall.dashboard',
                'params' => [

                ],

            ],
            'employee'=>[
                'permission' => 'dashboard',
                'icon' => 'user',
                'guard' => ['stall'],
                'title' => 'Employees',
                'route_name' => 'stall.employee.index',
                'params' => [

                ],
            ],
            'category'=>[
                'permission' => 'dashboard',
                'icon' => 'list',
                'guard' => ['stall'],
                'title' => 'Categories',
                'route_name' => 'stall.category.index',
                'params' => [

                ],
            ],
            'book'=>[
                'permission' => 'dashboard',
                'icon' => 'book-open',
                'guard' => ['stall'],
                'title' => 'Books',
                'route_name' => 'stall.book.index',
                'params' => [

                ],
            ],
            'coupon'=>[
                'permission' => 'dashboard',
                'icon' => 'clipboard',
                'guard' => ['stall'],
                'title' => 'Coupons',
                'route_name' => 'stall.coupon.index',
                'params' => [

                ],
            ],*/


        ];
    }
}
