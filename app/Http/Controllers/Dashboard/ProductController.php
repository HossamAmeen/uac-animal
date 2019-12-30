<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\Product;
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

    public function show_products($employee_id)
    {
        $products = EmployeeProduct::where('employee_id',$employee_id)->get();
    }
}
