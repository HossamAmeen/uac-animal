<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeTarget extends Model
{
    protected $table = "employee_target";
    public $timestamps = false;

    function product()
    {
        return $this->belongsTo(Product::class , 'product_id');
    }

    function empolyee()
    {
        return $this->belongsTo(Employee::class , 'employee_id');
    }
}
