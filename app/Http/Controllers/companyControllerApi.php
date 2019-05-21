<?php

namespace App\Http\Controllers;

use App\company;
use App\Http\Resources\companyResource;
use Illuminate\Http\Request;

class companyControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = company::orderBy('id','DESC')->paginate(10);
        return companyResource::collection($company);
    }
    public function indexAll()
    {
        $company = company::orderBy('name');
        return companyResource::collection($company);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = new company;
        if($company->create($request->all())){
            return new companyResource($company);
        }
        else {
        // return new productResource($request);
        return;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($company = company::find($id) ){
            return new companyResource($company);
        }
        else{
            return new companyResource(0);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = company::find($id);
        if($company->update($request->except('id'))){
            return new companyResource($company);
        }
        else{
            return new companyResource(0);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = company::find($id);
        if($company->delete()){
            return new companyResource($company);
        }
        else{
            return new companyResource(0);
        }
    }
}
