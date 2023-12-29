<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\URL;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function json_response($type,$code,$message,$status,$data='',$token='',$indexname='user')
    {
    	$response['type'] = $type;
    	$response['code'] = $code;
    	$response['message'] = $message;
    	$response['base_url'] = URL::to('/');
    	if(!empty($data)){
    		$response['data'] = $data;
    	}
    	if(!empty($token)){
    		$response['data']['token'] = $token;
    	}
    	return response()->json($response, $status);
    }
}
