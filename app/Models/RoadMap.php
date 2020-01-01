<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoadMap extends Model
{
    protected $table = "road_map";
    public $timestamps = false;

    function companies()
    {
        return $this->belongsTo(Company::class , 'company_id');
    }
}
