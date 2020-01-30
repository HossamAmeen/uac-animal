<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Models\EmployeeProduct;
use App\Models\RateEmployee;
use App\Models\Employee;
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
        $producd->visit_id = $request->visit_id;
        $producd->employee_id  = $request->employee_id ;
        $producd->save();
        $array = [
            'data' => null ,
            'status' =>  "success"  ,
            'error' => null,
        ];

        return response($array , 200);
    }

    public function add_rate_employee(Request $request)
    {
        $rate = new RateEmployee();
        $rate->employee_id  = $request->employee_id ;
        $rate->company_id = $request->company_id;
        $rate->rate  = $request->rate ;
        $rate->date  = date("Y/m/d") ;
        $rate->save();
        $employee = Employee::find($request->employee_id);
        if(isset($employee))
       {
        $employee->rate =  RateEmployee::where('employee_id' , $request->employee_id )->avg('rate');
        
        $employee->save();
       }
     
        
        $array = [
            'data' => null ,
            'status' =>  "success"  ,
            'error' => null,
        ];

        return response($array , 200);
    }
}
