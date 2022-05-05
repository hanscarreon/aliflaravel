<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pop', function (Blueprint $table) {
            $table->id('popId');
            $table->string('popBarangay');
            $table->string('popNameAddress');
            $table->string('popPrecinctNumber');
            $table->string('popRegisteredVoters');
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
        Schema::dropIfExists('pop');
    }
}
