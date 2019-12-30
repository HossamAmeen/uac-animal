<?php

namespace App\Http\Controllers\APIS;

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
}
