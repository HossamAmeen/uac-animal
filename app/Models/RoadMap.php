<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoadMap extends Model
{
    protected $table = "road_map";
    public $timestamps = false;

    function company()
    {
        return $this->belongsTo(Company::class , 'company_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
