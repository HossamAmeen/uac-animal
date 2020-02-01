<?php

namespace App\Http\Controllers\Mobile;
use App\Models\RoadMap;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoadMapController extends Controller
{
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
