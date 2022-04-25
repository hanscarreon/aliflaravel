<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcvlTable extends Migration
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
            $table->string('pcvlVotersMiddleName')->nullable();
            $table->string('pcvlVotersLastName')->nullable();
            $table->string('pcvlVotersExtensionName')->nullable();
            $table->string('pcvlVotersAddress')->nullable();
            $table->enum('pcvlMunicipality', ['angat','balagtas','baliuag','bocaue', 'bulakan'])->nullable();
            $table->enum('pcvlBarangay',['banaban','baybay','binagbag','donacion','encanto'])->nullable();
            $table->enum('pcvlDistrict',['district 1', 'district2','district 3', 'district 4'])->nullable();
            $table->timestamp('pcvlCreatedAt')->nullable();
            $table->timestamp('pcvlUpdatedAt')->nullable();
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
