<?php

namespace App\Http\Controllers\DashBoard;

use Illuminate\Http\Request;
use App\Models\RoadMap;
use DB;
use App\Http\Controllers\Controller;

class RoadMapController extends Controller
{

        /////// from mobile request
    public function store(Request $request)
    {
       
        $item = new RoadMap();
        $item->date = $request->date ; 
        $item->employee_id  = $request->employee_id ;
        $item->company_id = $request->company_id ;
        $item->save();
        $array = [
            'data' => null ,
            'status' =>  "success"  ,
            'error' => null,
        ];

        return response($array , 200);
    }

    public function get_companies(Request $request , $employee_id)
    {
        

        if(isset($request->dateFrom) ){
            
            $items = RoadMap::orderBy('id','DESC')
            ->where('employee_id' , $employee_id)
            ->whereBetween('date' , [$request->dateFrom, $request->dateTo])
           
            ->select('id','employee_id',"company_id", DB::raw('DATE(date) as date'))
            ->with('companies')
            ->get()
            ->groupBy('date');
        }
        else
        {
            $items = RoadMap::orderBy('id','DESC')
            ->where('employee_id' , $employee_id)
            ->select('id','employee_id',"company_id", DB::raw('DATE(date) as date'))
            ->with('companies')
            ->get()
            ->groupBy('date');
        
        }
        $array = [
            'data' => $items ,
            'status' =>  "success"  ,
            'error' => null,
        ];

        return response($array , 200);
    }
}
