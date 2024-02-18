<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\siteInfo;
use Illuminate\Http\Request;

class utellityController extends Controller
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
}
