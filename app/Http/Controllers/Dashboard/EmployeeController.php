<?php

namespace App\Http\Controllers\DashBoard;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Controllers\BackController;
use App\Http\Controllers\Controller;

class EmployeeController extends BackController
{
    public function __construct(Employee $model)
    {
        $this->model = $model;
    }

    public function store(Request $request)
    {
        $employee = new Employee();
        $employee->name = $request->name ; 
        $employee->username =  $request->username;
        $employee->password = $request->password ;
        $employee->area_id = implode("|",$request->area);
        $employee->phoneNum = $request->phone ;
        $employee->mod_id = $request->moderator ;
        $employee->image = " ";
        $employee->save();
        // return implode("|",$request->area);
        return $this->APIResponse(null, null, 200);
    }

    public function with()
    {
        return ['rate'];
    }
}
