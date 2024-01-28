<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class orderController extends Controller
{
    public $user_id;
    public function __construct()
    {
        $user = Auth::user();

        // Check if the user is authenticated before accessing the id property
        $this->user_id = $user ? $user->id : null;
    }
    public function store(Request $request)
    {
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
                $fileName = time() . '_' . $payment_recipt->getClientOriginalName();
                $payment_recipt->move(public_path('admin/img/order_attachment/'), $fileName);
                $payment_recipt = '/admin/img/order_attachment/' . $fileName;
            } else {
                $payment_recipt = null;
            }

            $order = order::create([
                'user_id'    => $request->user_id,
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
            ]);
            return $this->json_response('success', 'order_created', 'Order Created Successfully', 422);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }
    public function myOrder()
    {
        try {
            $order = order::where('user_id', $this->user_id)->get();
            return $this->json_response('success', 'my_order', 'My Orders get Successfully', 422, $order);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    public function orderById(Request $request)
    {
        try {
            if (strpos($request->id, 'client_') === 0) {
                $order = order::where('user_id', $request->id)->get();
            } else {
                $order = order::where('id', $request->id)->get();
            }
            return $this->json_response('success', 'my_order', 'My Orders get Successfully', 422, $order);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }
}
