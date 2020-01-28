<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\EmployeeProduct;
use App\Models\Product;
use DB;
use App\Http\Controllers\BackController;
use App\Http\Controllers\Controller;
use Image, Carbon, File;
class ProductController extends BackController
{
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function store(Request $request)
    {
        // $fileName = $this->uploadImage(  $request , 530 , 432 );

        $product = new Product();
        $product->name = $request->name ;
        $product->url = $request->url;
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

   
    protected function uploadImage(Request $request , $height = 400 , $width = 400){

        $photo = $request->file('image');
        $fileName = time().str_random('10').'.'.$photo->getClientOriginalExtension();
        $destinationPath = public_path('uploads/');
        $image = Image::make($photo->getRealPath())->resize($height, $width);

            // return $destinationPath;

         if(!is_dir($destinationPath) ){
             mkdir($destinationPath);
         }
        $image->save($destinationPath.$fileName,60);
        return 'uploads/'.$fileName;
    }

    protected function uploadImage2(Request $request , $height = 400 , $width = 400){

        $photo = $request->file('image');
        $fileName = time().str_random('10').'.'.$photo->getClientOriginalExtension();
        $destinationPath = public_path('uploads/');
        $image = Image::make($photo->getRealPath())->resize($height, $width);

            // return $destinationPath;

         if(!is_dir($destinationPath) ){
             mkdir($destinationPath);
         }
        $image->save($destinationPath.$fileName,60);
        $array = [
            'data' => 'uploads/'.$fileName ,
            'status' =>  "success"  ,
            'error' => null,
        ];
          return response($array , 200);
        return ;
    }

}
