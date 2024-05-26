<?php

namespace Database\Seeders;

use App\Libraries\AppLibrary;
use App\Models\Menu;
use Illuminate\Database\Seeder;


class MenuExpenseSeeder extends Seeder
{
    public function run()
    {
        $menus = [
            [
                'name'       => 'Expenses',
                'language'   => 'expenses',
                'url'        => '#',
                'icon'       => 'lab lab-item',
                'priority'   => 100,
                'status'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'children'   => [
                    [
                        'name'       => 'Categories',
                        'language'   => 'categories',
                        'url'        => 'categories',
                        'icon'       => 'lab lab-line-items',
                        'priority'   => 100,
                        'status'     => 1,
                        'created_at' => now(),
                        'updated_at' => now()

                    ],
                    [
                        'name'       => 'Expenses',
                        'url'        => 'expenses',
                        'language'   => 'expenses',
                        'icon'       => 'lab lab-line-add-purchase',
                        'priority'   => 100,
                        'status'     => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ],
                ]
            ],
        ];
        Menu::insert(AppLibrary::associativeToNumericArrayBuilder($menus));
    }
}
