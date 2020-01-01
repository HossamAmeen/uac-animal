<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeProduct extends Model
{
    public $timestamps = false;
    protected $table = "employee_product";

    function products()
    {
        return $this->belongsTo(Product::class , 'product_id');
    }
}
