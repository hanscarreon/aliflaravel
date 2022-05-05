<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipalityModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bulacanMunicipalBarangay', function (Blueprint $table) {
            $table->id('bulacanMunicipalBarangayId');
            $table->string('municipalName');
            $table->string('barangayName');
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
        Schema::dropIfExists('bulacanMunicipalBarangay');
    }
}
