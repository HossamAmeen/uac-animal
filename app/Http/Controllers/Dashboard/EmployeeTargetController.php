<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\EmployeeTarget;
use App\Models\EmployeeProduct;
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
        
        return response($array , 200);
    }

    public function store(Request $request)
    {

        $item = new EmployeeTarget();
        $item->target = $request->target ;
        $item->date_from = $request->date_from ;
        $item->date_to = $request->date_to ;
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
