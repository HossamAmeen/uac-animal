<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Moderator;
class ModeratorController extends Controller
{
    public function login(Request $request)
    {
         
        $moderator =   Moderator::where('userName',$request->username)->where('pass', $request->password)->first();

        if(isset($moderator))
        {
            $array = [
                'data' => null ,
                'status' =>  "success"  ,
                'error' => null,
            ];
          
            return response($array , 200);
        }
        else
        {
            $array = [
                'data' => null ,
                'status' =>  "failed"  ,
                'error' => "username or password not coorect",
            ];
          
            return response($array , 400);
        }
    }
}
