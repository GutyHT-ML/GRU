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
                    'name'=>'Saske',
                    'email'=>'saske@gru.com',
                    'password'=>'123',
                    'role_id'=>2
                ],
                [
                    'name'=>'Humberto',
                    'email'=>'humberto@gru.com',
                    'password'=>'123',
                    'role_id'=>2
                ],
                [
                    'name'=>'Kappa',
                    'email'=>'kappa@gru.com',
                    'password'=>'123',
                    'role_id'=>2
                ],
                [
                    'name'=>'Huny',
                    'email'=>'huny@gru.com',
                    'password'=>'123',
                    'role_id'=>2
                ],
                [
                    'name'=>'Alex',
                    'email'=>'alex@gru.com',
                    'password'=>'123',
                    'role_id'=>1
                ],
                [
                    'name'=>'Ferni',
                    'email'=>'ferni@gru.com',
                    'password'=>'123',
                    'role_id'=>1
                ],
                [
                    'name'=>'Axel',
                    'email'=>'axel@gru.com',
                    'password'=>'123',
                    'role_id'=>1
                ],
                [
                    'name'=>'Fernando',
                    'email'=>'fernando@gru.com',
                    'password'=>'123',
                    'role_id'=>1
                ],
            ]
        );

        $date = Carbon::now('America/Mexico_City');

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
                ],
                [
                    'name'=>'Periodo de tiempo',
                    'value'=>1,
                    'type'=>Indicator::$FREQ
                ]
            ]
        );

        DB::table('indicators')->insert(
            [
                [
                    'name'=>'Fecha de apertura',
                    'date'=>$date->toDateTime(),
                    'type'=> Indicator::$MIN_DATE
                ],
                [
                    'name'=>'Fecha de cierre',
                    'date'=>$date->addUnit('minute', 5)->toDateTime(),
                    'type'=>Indicator::$MAX_DATE
                ]
            ]
        );

        DB::table('categories')->insert(
            [
                [
                    'name'=>'No fue al jale',
                    'points'=>-50
                ],
                [
                    'name'=>'Si fue al jale',
                    'points'=>50
                ]
            ]
        );
    }
}
