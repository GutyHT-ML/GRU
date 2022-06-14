<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        DB::table('roles')->insert(
            [
                'name'=>'minion'
            ]
        );

        DB::table('roles')->insert(
            [
                'name'=>'nefario'
            ]
        );

        DB::table('roles')->insert(
            [
                'name'=>'gru'
            ]
        );

    }
}
