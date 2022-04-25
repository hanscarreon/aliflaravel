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
        Schema::create('pcvl_upload', function (Blueprint $table) {
            $table->id('pcvlUploadId');
            $table->string('pcvlUploadPrecinctNumber')->nullable();
            $table->string('pcvlUploadLegend')->nullable();
            $table->string('pcvlUploadVotersName')->nullable();
            $table->string('pcvlUploadVotersAddress')->nullable();
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
        Schema::dropIfExists('pcvl_upload');
    }
}
