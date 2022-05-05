<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PcvlModel extends Model
{
   protected $table = 'pcvl';
   protected $primaryKey = 'pcvlId';
   // protected $guarded = [];
   protected $fillable = [
      'pcvlPrecinctNumber',
      'pcvlLegend',
      'pcvlVotersFirstName',
      'pcvlVotersLastName',
      'pcvlVotersAddress',
      'pcvlDistrict',
      'pcvlMunicipality',
      'pcvlBarangay'
   ];
}
