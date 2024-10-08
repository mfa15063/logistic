<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\GeneralMail;
use App\Models\order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class orderController extends Controller
{
    public function index()
    {
        $orders = order::all();
        $type = 'all';
        $page = 'All';
        return view('admin.order.index', compact('orders', 'type', 'page'));
    }
    public function allNew()
    {
        $orders = order::where('approved', '0')->where('order_delivered', '0')->get();
        $type = 'new';
        $page = 'New';
        return view('admin.order.index', compact('orders', 'type', 'page'));
    }
    public function allrejected()
    {
        $orders = order::where('approved', '2')->where('order_delivered', '0')->get();
        $type = 'rejected';
        $page = 'Rejected';
        return view('admin.order.index', compact('orders', 'type', 'page'));
    }
    public function allPanding()
    {
        $orders = order::where('approved', '1')->where('order_delivered', '0')->get();
        $type = 'panding';
        $page = 'Underprocessing';
        return view('admin.order.index', compact('orders', 'type', 'page'));
    }
    public function allDelivered()
    {
        $orders = order::where('order_delivered', '1')->get();
        $type = 'delivered';
        $page = 'Delivered';
        return view('admin.order.index', compact('orders', 'type', 'page'));
    }
    public function create()
    {
        return view('admin.order.create');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'user_id'        => 'required|exists:users,client_id',
                'price'            => 'required',
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
        $data = $request->all();
        $data['status'] = 'New';
        $order = order::create($data);
        if ($order) {
            order::find($order->id)->update([
                'product_pic' => $product_pic,
                'payment_recipt' => $payment_recipt,
                'status' => 'Pending'
            ]);
        }
        $data = $order->toArray();
        $email = $order->client->email;
        $data['client_id'] = $order->user_id;
        $data['message'] = '';
        Mail::to($email)->send(new GeneralMail('order_update_to_client','Order: '.$order->id.' is Added.',$data));

        return redirect()->route('order.index')->with(['type'=>'success','message'=>"Order created successfully."]);
    }
    public function edit($id)
    {
        $order = order::find($id);
        return view('admin.order.edit', compact('order'));
    }
    public function update_status(Request $request,$id){
        $order = order::find($id);
        if(!$order){
            return redirect()->route('order.index')->with(['type'=>'error','message'=>"Order not found."]);
        }
        $email = $order->client->email;
        $orderId= $order->id;
        $order->update(['status'=>$request->status,'location'=>$request->location]);
        $order = Order::find($orderId);
        $data = $order->toArray();
        $data['client_id'] = $order->user_id;
        $data['message'] = '';
        Mail::to($email)->send(new GeneralMail('order_update_to_client','Order: '.$order->id.' status is updated.',$data));
        return redirect()->route('order.index')->with(['type'=>'success','message'=>"Order status updated successfully."]);
    }
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'user_id'        => 'required|exists:users,client_id',
                'price'            => 'required',
                'received_country' => 'required',
                'received_city'    => 'required',
                'received_address' => 'required',
                'delivered_country' => 'required',
                'delivered_city'   => 'required',
                'delivered_address' => 'required',
                'status' => 'required',
                'product_pic' => 'image',
                'payment_recipt' => 'image',
            ]
        );
        $order = order::find($id);
        if(!$order){
            return redirect()->route('order.index')->with(['type'=>'error','message'=>"Order not found."]);
        }
        $data = $request->all();
        if ($request->hasFile('product_pic')) {
            $product_pic = $request->file('product_pic');
            $fileName = time() . '_' . $product_pic->getClientOriginalName();
            $product_pic->move(public_path('admin/img/order_attachment/'), $fileName);
            $data['product_pic'] = '/admin/img/order_attachment/' . $fileName;
        }
        if ($request->hasFile('payment_recipt')) {
            $payment_recipt = $request->file('payment_recipt');
            $fileName = time() . '_' . $payment_recipt->getClientOriginalName();
            $payment_recipt->move(public_path('admin/img/order_attachment/'), $fileName);
            $data['payment_recipt'] = '/admin/img/order_attachment/' . $fileName;
        }
        $orderId= $order->id;
        $email = $order->client->email;
        $order->update($data);
        $order = Order::find($orderId);
        $data = $order->toArray();
        $data['client_id'] = $order->user_id;
        $data['message'] = '';
        Mail::to($email)->send(new GeneralMail('order_update_to_client','Order: '.$order->user_id.' is updated.',$data));
        return redirect()->route('order.index')->with(['type'=>'success','message'=>"Order updated successfully."]);
    }
    public function updateApproved(Request $request,$type,$id)
    {
        $order = order::find($id);
        if(!$order){
            return redirect()->route('order.index')->with(['type'=>'error','message'=>"Order not found."]);
        }
        $currentDate = Carbon::now()->format('Y-m-d');
        if($type == 'accept'){
            $order->approved = 1;
            $order->received_date = $currentDate;
            $order->status = 'Accepted';
            if($request->has('price')){
                $order->price = $request->input('price');
            }
        }
        elseif($type == 'reject'){
            $order->approved = 2;
            $order->rejection_reason = $request->rejection_reason;
            $order->status = 'Rejected';
            $order->location = null;
        }
        $email = $order->client->email;
        $data = $order->toArray();
        $data['client_id'] = $order->user_id;
        $data['message'] = '';
        $data['client_id'] = $order->user_id;
        Mail::to($email)->send(new GeneralMail('order_update_to_client','Order: '.$order->user_id.' is '.$order->status.'.',$data));

        $order->update();
        return redirect()->route('order.index');
    }
    public function updateDelivered($id)
    {
        $order = order::find($id);
        if(!$order){
            return redirect()->route('order.index')->with(['type'=>'error','message'=>"Order not found."]);
        }
        $currentDate = Carbon::now()->format('Y-m-d');
        if ($order->order_delivered) {
            $order->order_delivered = false;
            $order->delivered_date = null;
            $order->status = 'Not delivered yet';
        } else {
            $order->order_delivered = true;
            $order->delivered_date = $currentDate;
            $order->status = 'Delivered';
            $order->location = null;
        }
        $email = $order->client->email;
        $data = $order->toArray();
        $data['client_id'] = $order->user_id;
        $data['message'] = '';
        $data['client_id'] = $order->user_id;
        Mail::to($email)->send(new GeneralMail('order_update_to_client','Order: '.$order->user_id.' is '.$order->status.'.',$data));
        $order->update();
        return redirect()->route('order.index');
    }
    public function delete($id)
    {
        $order = order::find($id);
        if (!$order) {
            return redirect()->route('order.index')->with(['type'=>'error','message'=>"Order not found."]);
        }
        $order->delete();
        return redirect()->route('order.index')->with(['type'=>'success','message'=>"Order deleted successfully."]);
    }
}
