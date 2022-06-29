<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNefarioMinionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nefario_minion', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignIdFor(\App\Models\User::class, 'minion_id')->nullable(false);
            $table->foreignIdFor(\App\Models\User::class, 'nefario_id')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nefario_minions');
    }
}
