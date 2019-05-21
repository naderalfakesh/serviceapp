<?php

namespace App\Http\Controllers;
use App\http\Resources\contactResource;
use App\contact;
use Illuminate\Http\Request;

class contactControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = contact::orderBy('id','DESC')->with('company')->paginate(10);
        return contactResource::collection($contact);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contact = new contact;
        if($contact->create($request->all())){
            return new contactResource($contact);
        }
        else {
        // return new productResource($request);
        return;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = contact::find($id);
        if($contact->update($request->except('id'))){
            return new contactResource($contact);
        }
        else{
            return new contactResource(0);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = contact::find($id);
        if($contact->delete()){
            return new contactResource($contact);
        }
        else{
            return new contactResource(0);
        }
    }
}
