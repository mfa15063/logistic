<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Inquery;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    /*********************************************************
    *      This section manage inquery for contact us         *
    *********************************************************/
    public function indexInquery()
    {
        $inqueries = Inquery::all();
        return  view('admin.inqueries.index',compact('inqueries'));
    }
    public function createInquery()
    {
        return view('admin.inqueries.create');
    }
    public function storeInquery(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:250'
        ]);
        Inquery::create($request->all());
        return  redirect()->route('inquery.index')->with(['type'=>'success','message'=>"Inquery created successfully."]);
    }
    public function editInquery($id)
    {
        $inquery = Inquery::find($id);
        if (!$inquery){
            return   redirect()->route('inquery.index')->with(['type'=>'error','message'=>"This inquery is not found."]);
        }
        return view('admin.inqueries.edit',compact('inquery'));
    }
    public function updateInquery(Request $request,$id)
    {
        $request->validate([
            'name'=>'required|string|max:250'
        ]);
        $inquery = Inquery::find($id);
        if (!$inquery){
            return   redirect()->route('inquery.index')->with(['type'=>'error','message'=>"This inquery is not found."]);
        }
        $inquery->update($request->all());
        return  redirect()->route('inquery.index')->with(['type'=>'success','message'=>"Inquery update successfully."]);
    }
    public function deleteInquery($id)
    {
        $inquery = Inquery::find($id);
        if (!$inquery){
            return   redirect()->route('inquery.index')->with(['type'=>'error','message'=>"This inquery is not found."]);
        }else{
            $inquery->delete();
            return   redirect()->route('inquery.index')->with(['type'=>'success','message'=>"Inquery deleted Successfully."]);
        }
    }
    // api for show list of inquiry
    public function  getListOfInquiry(){
        try {
            $inquiries = Inquery::all();
            return $this->json_response('success', 'inquiries', 'Inquiry Listing.', 200, $inquiries);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }
}
