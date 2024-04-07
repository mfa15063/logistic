<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\siteInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class utillityController extends Controller
{
    // get admin contact details
    public function  getAdminContactDetails()
    {
        try {
            $siteInfo = siteInfo::first();
            return $this->json_response('success', 'user created', 'Admin Contact Details.', 200, $siteInfo);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }
    // create contact detail
    public function contactUs(Request $request){
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'client_id'=>'exists:users,client_id',
                    'first_name' => 'required|string|max:50',
                    'last_name'    => 'required|string|max:50',
                    'email' => 'required|email|max:50',
                    'phone_number' => 'required|string|max:20',
                    'company_name'   => 'required|string|max:50',
                    'company_url' => 'required|url|max:250',
                    'company_address' => 'required|string|max:400',
                    'company_country' => 'required|string|max:50',
                    'company_city' => 'required|string|max:50',
                    'inquiry_id' => 'required|exists:inqueries,id',
                    'message' => 'required|string',
                ]
            );

            if ($validator->fails()) {
                return $this->json_response('error', 'validation_failed', $validator->errors()->first(), 422);
            }
            $data = $request->all();
            $user = User::where('email',$request->email)->first();
            if($user){
                $data['client_id']=$user->client_id;
            }
            $contact_us = ContactUs::create($data);
            return $this->json_response('success', 'contact_us_created', 'Contact us created Successfully', 200, $contact_us);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }
}
