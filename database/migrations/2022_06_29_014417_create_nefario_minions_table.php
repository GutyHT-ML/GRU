<?php

use App\Models\User;
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
            $table->bigIncrements('id');
            $table->foreignIdFor(User::class, 'minion_id')->constrained('users');
            $table->foreignIdFor(User::class, 'nefario_id')->constrained('users');
            $table->softDeletes();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nefatio_minions');
        Schema::dropIfExists('nefario_minion');
    }
}
