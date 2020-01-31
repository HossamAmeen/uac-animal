<?php

namespace App\Http\Controllers\Mobile;

use App\Models\EmployeeTarget;
use App\Models\EmployeeProduct;
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
    $array = json_encode($array);
    return response($array , 200);
   } 
   
   public function targetForMandob(Request $request)
   {
   
       $data = array();
     $items = EmployeeTarget::orderBy('id' , 'DESC')->where('employee_id',$request->employee_id)->with(['product' , 'empolyee'])->get();
     if(isset($request->dateFrom) ){
       $items = EmployeeTarget::orderBy('id' , 'DESC')->with(['product' , 'empolyee'])
                               ->where('employee_id',$request->employee_id)
                               ->where('date_from' ,'>=',$request->dateFrom)
                               ->where('date_to','<=', $request->dateTo)
                               ->get();
        }
       // return $items;
       foreach($items as $item ){
           $datas['id']=$item->id;
           $datas['target']=$item->target;
           $datas['date_from']=$item->date_from;
           $datas['date_to']=$item->date_to;
           $datas['product_name']=$item->product->name;
           $datas['empolyee_name']=$item->empolyee->name;
           // return $item->date_to; 
           $datas['sell_product'] = EmployeeProduct::where('employee_id',$request->employee_id)
                                           ->whereBetween('date' , [$item->date_from, $item->date_to])
                                           ->where('product_id' ,$item->product->id )
                                           ->sum('count');
                                       //     $datas['sell_product'] = EmployeeProduct::where('employee_id',$request->employee_id)
                                       //     ->whereBetween('date' , [$item->date_from, $item->date_to])
                                       //     ->where('product_id' ,$item->product->id )
                                       //     ->get('count');
                                       //    return $datas['sell_product'] ;
           // $datas['sell_product']=
           $data[]=$datas;
       }
       $array = [
           'data' => $data ,
           'status' =>  "success"  ,
           'error' => null,
       ];
       $array = json_encode($array);
       return response($array , 200);
   }

  //  public function targetForMandob(Request $request)
  //  {
  //    $tagets = \App\Models\EmployeeTarget::orderBy('id' , 'DESC')->where('employee_id',$request->employee_id)->with(['product'])->get();
  //   $data= array();
  //    foreach($tagets as $target){
  //       $datas['product_name'] = $target->product->name;
  //       // $data['sell_item'] = ;
  //       $datas['target'] = $target->target;

  //       $data[]=$datas;
  //    }
  //    $array = [
  //        'data' => $data ,
  //        'status' =>  "success"  ,
  //        'error' => null,
  //    ];

  //    return response($array , 200);
  //  }
}
