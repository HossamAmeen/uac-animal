<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Models\EmployeeProduct;
use App\Http\Controllers\BackController;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function show_products($employee_id)
    {
        $products = EmployeeProduct::where('employee_id',$employee_id)->get();
    }
}
