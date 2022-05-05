<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePclvUploadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcvl', function (Blueprint $table) {
            $table->id('pcvlId');
            $table->string('pcvlPrecinctNumber')->nullable();
            $table->string('pcvlLegend')->nullable();
            $table->string('pcvlVotersFirstName')->nullable();
            $table->string('pcvlVotersLastName')->nullable();
            $table->string('pcvlVotersAddress')->nullable();
            $table->string('pcvlDistrict')->nullable();
            $table->string('pcvlMunicipality')->nullable();
            $table->string('pcvlBarangay')->nullable();
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
        Schema::dropIfExists('pcvl');
    }
}
