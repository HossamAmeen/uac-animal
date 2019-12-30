<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Models\EmployeeProduct;
use App\Http\Controllers\BackController;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
   
    public function add_product(Request $request)
    {
        $producd = new EmployeeProduct();
        $producd->date = $request->date;
        $producd->count = $request->count;
        $producd->product_id = $request->product_id;
        $producd->employee_id  = $request->employee_id ;
        $producd->save();
        $array = [
            'data' => null ,
            'status' =>  "success"  ,
            'error' => null,
        ];

        return response($array , 200);
    }
}
