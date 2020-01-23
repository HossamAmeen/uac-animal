<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RepresentativeController extends Controller
{
   public function getRepresentativeBySupervisor($supervisorId)
   {
   
    $representatives =  \App\Models\Employee::where('mod_id' , $supervisorId)->get();
   
    $array = [
        'data' => $representatives ,
      
    ];

    return response($array , 200);
   } 
       
   public function targetForMandob(Request $request)
   {
     $tagets = \App\Models\EmployeeTarget::orderBy('id' , 'DESC')->where('employee_id',$request->employee_id)->with(['product'])->get();
    $data= array();
     foreach($tagets as $target){
        $datas['product_name'] = $target->product->name;
        // $data['sell_item'] = ;
        $datas['target'] = $target->target;

        $data[]=$datas;
     }
     $array = [
         'data' => $data ,
         'status' =>  "success"  ,
         'error' => null,
     ];

     return response($array , 200);
   }
}
