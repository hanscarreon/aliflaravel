<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PcvlUpload extends Model
{
   protected $table = 'pcvl_upload';
   protected $primaryKey = 'pcvlUploadId';
   // protected $guarded = [];
   protected $fillable = [
      'pcvlUploadPrecinctNumber',
      'pcvlUploadLegend',
      'pcvlUploadVotersName',
      'pcvlUploadVotersAddress',
      'pcvlMunicipality',
      'pcvlBarangay'
   ];
}
