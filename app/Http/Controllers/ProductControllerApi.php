<?php

namespace App\Http\Controllers;
use App\product;
use App\Http\Resources\productResource;
use Illuminate\Http\Request;

class ProductControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = product::orderBy('created_at','DESC')->paginate(10);
        return productResource::collection($product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $product = new product;
      if($product->create($request->all())){
        return new productResource($product);
      }
      else {
        // return new productResource($request);
        return;
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $product = product::find($id);
       if($product->update($request->except('id'))){
           return new productResource($product);
       }
       else{
           return new productResource(0);
       }  //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $product = product::find($id);
        if($product->delete()){
            return new productResource($product);
        }
        else{
            return new productResource(0);
        }
    }
}
