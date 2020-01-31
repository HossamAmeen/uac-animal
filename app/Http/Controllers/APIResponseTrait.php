<?php


namespace App\Http\Controllers;

trait APIResponseTrait
{
    public function APIResponse($data = null , $error = null , $code = 200)
    {
        $array = [
            'data' => $data ,
            'status' => in_array($code , [200 , 201 , 202]) ? "success" : "falied" ,
            'error' => $error,
        ];
        // return json_encode($array , JSON_UNESCAPED_UNICODE) ;
        $array = json_encode($array);
        return response($array , $code);
    }
}
