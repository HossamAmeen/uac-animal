<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Visit;
use App\Models\EmployeeProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function getAccount( Request $request)
    {
        $company = \App\Models\Company::find($request->id);

        // $myJSON = json_encode($company);
        
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

    public function updateVisit(Request $request , $visit_id)
    {
        $visit = Visit::find($visit_id);
        
      if(isset($visit->id) )
        {
            $visit->company_id =$request->company_id;
            $visit->time =$request->time;
            $visit->comment =$request->comment;
            $visit->rate =$request->rate;
            $visit->is_enable =$request->is_enable;
            $visit->save();
            // return $visit;
           $products = \App\Models\EmployeeProduct::where('visit_id' , $visit_id);
           $products->delete();
        
           for($i = 0 ; $i < count($request->products);$i++){
            $newProducts = new EmployeeProduct();
            $newProducts->count = $request->count[$i];
            $newProducts->product_id = $request->products[$i];
            $newProducts->employee_id = $request->employee_id; 
            $newProducts->date = date("Y/m/d");
            $newProducts->visit_id = $visit_id;
            $newProducts->save();
           }
           
            return response("update successfully" , 200);
        }
        else
        {
            return response("not found" , 404);
        }
    }
}
