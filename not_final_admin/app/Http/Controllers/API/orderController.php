<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\GeneralMail;
use App\Models\order;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class orderController extends Controller
{
    public $user_id,$client_id,$user;
    public function __construct()
    {
        $this->user = auth()->user();

        // Check if the user is authenticated before accessing the id property
        $this->user_id = $this->user ? $this->user->id : null;
        $this->client_id = $this->user ? $this->user->client_id : null;
    }
    public function store(Request $request)
    {
//        // Ensure the user is authenticated
//        if (!$this->client_id) {
//            return $this->json_response('error', 'unauthorized', 'User is not authenticated.', 403);
//        }

        $validator = Validator::make(
            $request->all(),
            [
                'received_country' => 'required',
                'received_city'    => 'required',
                'received_address' => 'required',
                'delivered_country' => 'required',
                'delivered_city'   => 'required',
                'delivered_address' => 'required',
                'product_pic' => 'image',
                'payment_recipt' => 'image',
            ]
        );
        if ($validator->fails()) {
            return $this->json_response('error', 'validation_failed', $validator->errors()->first(), 422);
        }
        try {
            if ($request->hasFile('product_pic')) {
                $product_pic = $request->file('product_pic');
                $fileName = time() . '_' . $product_pic->getClientOriginalName();
                $product_pic->move(public_path('admin/img/order_attachment/'), $fileName);
                $product_pic = '/admin/img/order_attachment/' . $fileName;
            } else {
                $product_pic = null;
            }
            if ($request->hasFile('payment_recipt')) {
                $payment_recipt = $request->file('payment_recipt');
                $fileName = time() . '_' . $payment_recipt
                        ->getClientOriginalName();
                $payment_recipt->move(public_path('admin/img/order_attachment/'), $fileName);
                $payment_recipt = '/admin/img/order_attachment/' . $fileName;
            } else {
                $payment_recipt = null;
            }
            $order = order::create([
                'user_id'    => "client_1",
                'receiver_name'    => $request->receiver_name,
                'received_country' => $request->received_country,
                'received_city'    => $request->received_city,
                'received_address' => $request->received_address,
                'delivered_country' => $request->delivered_country,
                'delivered_city'   => $request->delivered_city,
                'delivered_address' => $request->delivered_address,
                'status'           => 'Pending',
                'product_pic'      => $product_pic,
                'payment_recipt'   => $payment_recipt,
                'location'         =>$request->location
            ]);
//        $email = User::where('is_admin',1)->first()->email;
        $data = $order->toArray();
        $data['client_id'] = $order->user_id;
        $data['message'] = '';
        $data['client_id'] = $order->user_id;
//        Mail::to($email)->send(new GeneralMail('order_update_to_client','Order: '.$order->id.' is created.',$data));
            return $this->json_response('success', 'order_created', 'Order Created Successfully', 200, ["order_id"=> $order->id]);
        } catch (\Exception $e) {
            return response()->json(['type'=>'internal_error','message'=>$e->getMessage()], 404);
        }
    }
    public function myOrder()
    {
        try {
            $order = order::where('user_id', $this->client_id)->get();
            return $this->json_response('success', 'my_order', 'My Orders get Successfully', 200, $order);
        } catch (\Exception $e) {
            return response()->json(['type'=>'internal_error','message'=>$e->getMessage()], 404);
        }
    }

    public function orderById(Request $request)
    {
        try {
            $query = Order::query();
            $query->with('client');
            if (strpos($request->id, 'client_') === 0) {
                $query->where('user_id', $request->id);
            } else {
                $query->where('id', $request->id);
            }
            $order = $query->get();
            if (count($order) > 0)
                return $this->json_response('success', 'my_order', 'My Orders get Successfully', 200, $order);
            else return $this->json_response('fail', 'not_found', 'Order Not Found!', 404);
        } catch (\Exception $e) {
            return response()->json(['type'=>'internal_error','message'=>$e->getMessage()], 404);
        }
    }
    public function orderDelete($id)
    {
        try {
            $order = Order::find($id);
            if(!$order){
                return $this->json_response('fail', 'not_found', 'Order Not Found!', 404);
            }
            $order->delete();
            return $this->json_response('success', 'order_deleted', 'Orders Deleted Successfully', 200);
        } catch (\Exception $e) {
            return response()->json(['type'=>'internal_error','message'=>$e->getMessage()], 404);
        }
    }
}
