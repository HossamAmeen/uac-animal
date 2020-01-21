<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\EmployeeTarget;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeTargetController extends Controller
{
    public function index()
    {
        $items = EmployeeTarget::orderBy('id' , 'DESC')->with(['product' , 'empolyee'])->get();

        $array = [
            'data' => $items ,
            'status' =>  "success"  ,
            'error' => null,
        ];

        return response($array , 200);
    }
    public function targetForMandob(Request $request)
    {
      $items = EmployeeTarget::orderBy('id' , 'DESC')->where('employee_id',$request->employee_id)->with(['product' , 'empolyee'])->get();
      $array = [
          'data' => $items ,
          'status' =>  "success"  ,
          'error' => null,
      ];

      return response($array , 200);
    }

    public function store(Request $request)
    {

        $item = new EmployeeTarget();
        $item->target = $request->target ;
        $item->date = $request->date ;
        $item->employee_id  = $request->employee_id ;
        $item->product_id = $request->product_id ;
        $item->save();
        $array = [
            'data' => null ,
            'status' =>  "success"  ,
            'error' => null,
        ];

        return response($array , 200);
    }

    public function update(Request $request , $id)
    {
        $item = EmployeeTarget::find($id);
        $item->target = $request->target ;
        $item->date = $request->date ;
        $item->employee_id  = $request->employee_id ;
        $item->product_id = $request->product_id ;
        $item->save();
        // return  $item ;
        $array = [
            'data' => null ,
            'status' =>  "success"  ,
            'error' => null,
        ];

        return response($array , 200);
    }

    public function delete($id)
    {
        $item = EmployeeTarget::find($id);
        $item->delete();
        $array = [
            'data' => null ,
            'status' =>  "success"  ,
            'error' => null,
        ];

        return response($array , 200);
    }
}
