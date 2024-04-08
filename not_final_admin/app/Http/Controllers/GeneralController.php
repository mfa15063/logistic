<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\GeneralMail;
use App\Models\ContactUs;
use App\Models\Inquery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class GeneralController extends Controller
{
    /*********************************************************
    *      This section manage inquery for contact us         *
    *********************************************************/
    public function indexInquiry()
    {
        $inquiries = Inquery::all();
        return  view('admin.inquiries.index',compact('inquiries'));
    }
    public function createInquiry()
    {
        return view('admin.inquiries.create');
    }
    public function storeInquiry(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:250'
        ]);
        Inquery::create($request->all());
        return  redirect()->route('inquiry.index')->with(['type'=>'success','message'=>"Inquery created successfully."]);
    }
    public function editInquiry($id)
    {
        $inquery = Inquery::find($id);
        if (!$inquery){
            return   redirect()->route('inquiry.index')->with(['type'=>'error','message'=>"This inquery is not found."]);
        }
        return view('admin.inquiries.edit',compact('inquery'));
    }
    public function updateInquiry(Request $request,$id)
    {
        $request->validate([
            'name'=>'required|string|max:250'
        ]);
        $inquery = Inquery::find($id);
        if (!$inquery){
            return   redirect()->route('inquiry.index')->with(['type'=>'error','message'=>"This inquery is not found."]);
        }
        $inquery->update($request->all());
        return  redirect()->route('inquiry.index')->with(['type'=>'success','message'=>"Inquery update successfully."]);
    }
    public function deleteInquiry($id)
    {
        $inquery = Inquery::find($id);
        if (!$inquery){
            return   redirect()->route('inquiry.index')->with(['type'=>'error','message'=>"This inquery is not found."]);
        }else{
            $inquery->delete();
            return   redirect()->route('inquiry.index')->with(['type'=>'success','message'=>"Inquery deleted Successfully."]);
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
    // contact us listing
    public function contactUs()
    {
        $contactUses = ContactUs::with('inquiry')->get();
        return view('admin.contactUs',compact('contactUses'));
    }
    public function deleteContactUs($id){
        $contactUs = ContactUs::find($id);
        if(!$contactUs){
            return redirect()->route('contact_us')->with(['type'=>'error','message'=>'Contact us not found']);
        }
        $contactUs->delete();
        return redirect()->route('contact_us')->with(['type'=>'success','message'=>'Contact us deleted successfully']);
    }
    // compose mail to customer from admin
    public function contactUsComposeMail($id){
        $contactUs = ContactUs::find($id);
        if(!$contactUs){
            return redirect()->route('contact_us')->with(['type'=>'error','message'=>'Contact Us Not Found']);
        }
        return view('admin.sendMailToContactUs',compact('contactUs'));
    }
    public function contactUsSendMail(Request $request,$id){
        $request->validate([
            'email'=>'required|email',
            'subject'=>'required',
            'message'=>'required'
        ]);
        $contactUs = ContactUs::find($id);
        if(!$contactUs){
            return redirect()->route('contact_us')->with(['type'=>'error','message'=>'Contact Us Not Found']);
        }
        $data = [
            'name'=>$contactUs->first_name.' '.$contactUs->last_name,
            'message'=>$request->message
        ];
        Mail::to($request->email)->send(new GeneralMail('contact_us_customer',$request->subject,$data));
        return redirect()->route('contact_us')->with(['type'=>'success','message'=>'Mail Send  Successfully']);
    }
}
