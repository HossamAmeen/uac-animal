<?php

namespace App\Http\Controllers\Mobile;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function getAccount( Request $request)
    {
        $company = \App\Models\Company::find($request->id);

       
        if(isset($company)){
            $array = [
                'data' => $company,
              
            ];
        }
        else
        $array = [
            'data' => "not found" ,
          
        ];

        return response($array , 200);
    }

    public function updateVisit(Request $request , $id)
    {
        $visit = \App\Models\Visit::find($id);
        
      if(isset($visit->id) )
        {
            $visit->company_id =$request->company_id;
            $visit->time =$request->time;
            $visit->comment =$request->comment;
            $visit->rate =$request->rate;
            $visit->product_id =$request->product_id;
            $visit->amount =$request->amount;
            $visit->is_enable =$request->is_enable;
            $visit->save();
            // return $visit;
            return response("update successfully" , 200);
        }
        else
        {
            return response("not found" , 404);
        }
    }
}
