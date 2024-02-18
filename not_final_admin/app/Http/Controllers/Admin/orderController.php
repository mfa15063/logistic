<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
                'user_id'        => 'required|exists:users,id',
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
                'status' => 'Panding'
            ]);
        }
        return redirect()->route('order.index');
    }
    public function edit($id)
    {
        $order = order::find($id);
        return view('admin.order.edit', compact('order'));
    }
    public function update_status(Request $request,$id){
        $order = order::findorFail($id);
        if ($order) {
            $order->update(['status'=>$request->status]);
        }
        return redirect()->back();
    }
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'user_id'        => 'required|exists:users,id',
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
        $order = order::find($id)->update($data);
        return redirect()->route('order.index');
    }
    public function updateApproved(Request $request,$type,$id)
    {
        $order = order::findorFail($id);
        $currentDate = Carbon::now()->format('Y-m-d');
        if ($order) {
            if($type == 'accept'){
                $order->approved = 1;
                $order->received_date = $currentDate;
                if($request->has('price')){
                    $order->price = $request->input('price');
                }
            }
            elseif($type == 'reject'){
                $order->approved = 2;
                $order->rejection_reason = $request->rejection_reason;
                $order->status = 'Rejected';
            }
        }
        $order->update();
        return redirect()->route('order.index');
    }
    public function updateDelivered($id)
    {
        $order = order::findorFail($id);
        $currentDate = Carbon::now()->format('Y-m-d');
        if ($order) {
            if ($order->order_delivered) {
                $order->order_delivered = false;
                $order->delivered_date = null;
            } else {
                $order->order_delivered = true;
                $order->delivered_date = $currentDate;
                $order->status = 'Delivered';
            }
        }
        $order->update();
        return redirect()->route('order.index');
    }
    public function delete($id)
    {
        $order = order::find($id);
        if ($order) {
            $order->delete();
        }
        return redirect()->route('order.index');
    }
}
