<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\EmployeeProduct;
use App\Models\Product;
use DB;
use App\Http\Controllers\BackController;
use App\Http\Controllers\Controller;

class ProductController extends BackController
{
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function store(Request $request)
    {
        $fileName = $this->uploadImage(  $request , 530 , 432 );
        
        $product = new Product();
        $product->name = $request->name ; 
        $product->url = $fileName;
        $product->description = $request->description ;
        $product->price = $request->price ;
        $product->save();

        return $this->APIResponse(null, null, 200);
    }

    public function show_products(Request $request ,$employee_id)
    {
        if(isset($request->dateFrom) ){
           
            $items = EmployeeProduct::orderBy('id','DESC')
            ->where('employee_id' , $employee_id)
            ->whereBetween('date' , [$request->dateFrom, $request->dateTo])
           
            ->select('id','employee_id',"product_id", DB::raw('DATE(date) as date'))
            ->with('products')
            ->get()
            ->groupBy('date');
        }
        else
        {
            $items = EmployeeProduct::orderBy('id','DESC')
            ->where('employee_id' , $employee_id)
            ->select('id','employee_id',"product_id", DB::raw('DATE(date) as date'))
            ->with('products')
            ->get()
            ->groupBy('date');
        
        }
        return $this->APIResponse($items, null, 200);
        
      
    }

    
}
