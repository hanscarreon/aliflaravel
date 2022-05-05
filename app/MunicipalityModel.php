<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MunicipalityModel extends Model
{
    protected $table = 'bulacanmunicipalbarangay';
    protected $primaryKey = 'bulacanmunicipalbarangayId';

    protected $guarded = [];

}
