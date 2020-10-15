<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = '';
        $editor = '';
        $writer = '';

        $permissions = collect([]);

        $permissions_by_role = [
            'admin' => [],
            'editor' => [],
            'writer' => [],
        ];
    }
}
