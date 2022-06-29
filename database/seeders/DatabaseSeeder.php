<?php

namespace Database\Seeders;

use App\Models\Indicator;
use Carbon\Carbon;
use Carbon\Traits\Date;
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
                [
                    'name'=>'minion'
                ],
                [
                    'name'=>'nefario'
                ],
                [
                    'name'=>'gru'
                ]
            ]
        );



        DB::table('users')->insert(
            [
                [
                    'name'=>'JairGay',
                    'email'=>'jair@gru.com',
                    'password'=>'123',
                    'role_id'=>'3'
                ],
                [
                    'name'=>'Alex',
                    'email'=>'alex@gru.com',
                    'password'=>'123',
                    'role_id'=>1
                ],
                [
                    'name'=>'Saske',
                    'email'=>'saske@gru.com',
                    'password'=>'123',
                    'role_id'=>2
                ]
            ]
        );

        $date = Carbon::now('UTC')->addMonths(1);

        DB::table('indicators')->insert(
            [
                [
                    'name'=>'Puntaje minimo',
                    'value'=>5,
                    'type'=>Indicator::$MIN_NUM
                ],
                [
                    'name'=>'Puntaje maximo',
                    'value'=>100,
                    'type'=>Indicator::$MAX_NUM
                ]
            ]
        );

        DB::table('indicators')->insert(
            [
                [
                    'name'=>'Fecha de apertura',
                    'date'=>$date->toDate(),
                    'type'=> Indicator::$MIN_DATE
                ],
                [
                    'name'=>'Fecha de cierre',
                    'date'=>$date->toDate(),
                    'type'=>Indicator::$MAX_DATE
                ]
            ]
        );
    }
}
