<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use App\Models\RoadMap;
use DB;
use Illuminate\Http\Request;

class RoadMapController extends Controller
{

    /////// from mobile request
    public function store(Request $request)
    {

        $item = new RoadMap();
        $item->date = $request->date;
        $item->employee_id = $request->employee_id;
        $item->company_id = $request->company_id;
        $item->save();
        $array = [
            'data' => null,
            'status' => "success",
            'error' => null,
        ];

        return response($array, 200);
    }

  

    public function get_companies_test(Request $request, $employee_id)
    {

       
        $roadMaps = RoadMap::with(['company'])->orderBy('id', 'DESC')->where('employee_id', $employee_id)->get();
        $data = array();
        if (isset($request->dateFrom)) {

            // $data['notVisited'] = RoadMap::orderBy('id','DESC')
            // ->where('employee_id' , $employee_id)
            // ->whereNotIn('company_id' , $visits)
            // ->select('id','employee_id',"company_id", DB::raw('DATE(date) as date'))
            // ->whereBetween('date' , [$request->dateFrom, $request->dateTo])
            // ->with('companies')
            // ->get();
            // // ->groupBy('date');

            // $data['visited'] = RoadMap::orderBy('id','DESC')
            // ->where('employee_id' , $employee_id)
            // ->whereIn('company_id' , $visits)
            // ->whereBetween('date' , [$request->dateFrom, $request->dateTo])
            // ->select('id','employee_id',"company_id", DB::raw('DATE(date) as date'))
            // ->with('companies')
            // ->get();
            // ->groupBy('date');
            // $roadMaps = RoadMap::orderBy('id', 'DESC')->where('employee_id', $employee_id)
            //     ->whereBetween('date', [$request->dateFrom, $request->dateTo])
            //     ->get();
            // return $roadMaps;
            $roadMaps = $roadMaps->whereBetween('date' , [$request->dateFrom, $request->dateTo]);

        } 
        $data['notVisited'] =array();
        $data['visited'] = array();
        foreach($roadMaps as $roadMap){
            if($roadMap->visit_id == null)
            {
                $data['notVisited'][] = $roadMap ;
            }
            else
            {
                $data['visited'][] = $roadMap ;
            }
           
        }
        $array = [
            'data' => $data,
            'status' => "success",
            'error' => null,
        ];
        // foreach ($data['visited'] as $key => $value) {
        //   echo $value->companies->name;
        // }
        // $text ;
        // return json_encode($array, JSON_UNESCAPED_UNICODE);
        // return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
        // return json_encode($array);
        return response($array, 200);
    }
}
