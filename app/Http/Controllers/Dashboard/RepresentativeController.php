<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\Moderator;
use App\Http\Controllers\BackController;
use App\Http\Controllers\Controller;

class RepresentativeController extends BackController
{     
    public function __construct(Moderator $model)
    {
        $this->model = $model;
    }
    
    protected function filter($rows)
    {
        return $rows->where('trash' , 0);
    }
    
    public function getRepresentativeBySupervisor($supervisorId)
    {
    $area_number = Moderator::find($supervisorId);
     $representatives =  \App\Models\Employee::where('mod_id' , $supervisorId)->get();
    //  $data['NewRepresentatives'] =  \App\Models\Employee::where('mod_id' ,'!=', $supervisorId)->get();
     $array = [
         'data' => $representatives ,
       
     ];
     $array = json_encode($array);
     return response($array , 200);
    } 

    public function addRepresentForModerators(Request $request)
    {
        
    }
}
