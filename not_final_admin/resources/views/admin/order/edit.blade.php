@extends('admin.layouts.main')
@section('content')
    <div class="pagetitle">
        <h1>Edit Order</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Order</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Recent Sales -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Enter Order Details</h5>
                        <form class="row g-3" method="POST" action="{{ route('order.update', $order->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <label for="user_id" class="form-label">Client ID <sup
                                        class="text-danger"><b>*</b></sup></label>
                                <input type="text" class="form-control  @error('user_id') is-invalid @enderror"
                                    value="{{ old('user_id', $order->user_id) }}" name="user_id" id="user_id"
                                    placeholder="Client ID">
                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price <sup
                                        class="text-danger"><b>*</b></sup></label>
                                <input type="number" class="form-control @error('Price') is-invalid @enderror"
                                    value="{{ old('price', $order->price) }}" name="price" id="price"
                                    placeholder="Price">
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="product_pic" class="form-label">Product Picture</label>
                                <input type="file" class="form-control @error('product_pic') is-invalid @enderror"
                                    name="product_pic" id="product_pic" placeholder="Product Pic">
                                @error('product_pic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="payment_recipt" class="form-label">Payment Recipt</label>
                                <input type="file" class="form-control @error('payment_recipt') is-invalid @enderror"
                                    name="payment_recipt" id="payment_recipt" placeholder="Payment Recipt">
                                @error('payment_recipt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" class="form-control" name="status"
                                    value="{{ old('status', $order->status) }}" id="status"
                                    placeholder="Status of Order">
                            </div>
                            <h5 class="form_title">Received From</h5>

                            <div class="col-md-6">
                                <label for="received_country" class="form-label">Country <sup
                                        class="text-danger"><b>*</b></sup></label>
                                <input type="text" class="form-control @error('received_country') is-invalid @enderror"
                                    value="{{ old('received_country', $order->received_country) }}" name="received_country"
                                    id="received_country" placeholder="Country">
                                @error('received_country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="received_city" class="form-label">City <sup
                                        class="text-danger"><b>*</b></sup></label>
                                <input type="text" class="form-control @error('received_city') is-invalid @enderror"
                                    value="{{ old('received_city', $order->received_city) }}" name="received_city"
                                    id="received_city" placeholder="City">
                                @error('received_city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="received_address" class="form-label">Address <sup
                                        class="text-danger"><b>*</b></sup></label>
                                <input type="text" class="form-control @error('received_address') is-invalid @enderror"
                                    value="{{ old('received_address', $order->received_address) }}"
                                    name="received_address" id="received_address" placeholder="Address">
                                @error('received_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <h5 class="form_title">Delivered To</h5>
                            <div class="col-md-6">
                                <label for="name" class="form-label">Parsel Receiver Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $order->receiver_name) }}" id="name"
                                    placeholder="Receiver Name ">
                            </div>
                            <div class="col-md-6">
                                <label for="delivered_country" class="form-label">Country <sup
                                        class="text-danger"><b>*</b></sup></label>
                                <input type="text"
                                    class="form-control @error('delivered_country') is-invalid @enderror"
                                    name="delivered_country" id="delivered_country"
                                    value="{{ old('delivered_country', $order->delivered_country) }}"
                                    placeholder="Country">
                                @error('delivered_country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="delivered_city" class="form-label">City <sup
                                        class="text-danger"><b>*</b></sup></label>
                                <input type="text" class="form-control @error('delivered_city') is-invalid @enderror"
                                    name="delivered_city" id="delivered_city"
                                    value="{{ old('delivered_city', $order->delivered_city) }}" placeholder="City">
                                @error('delivered_city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="delivered_address" class="form-label">Address <sup
                                        class="text-danger"><b>*</b></sup></label>
                                <input type="text"
                                    class="form-control @error('delivered_address') is-invalid @enderror"
                                    name="delivered_address" id="delivered_address"
                                    value="{{ old('delivered_address', $order->delivered_address) }}"
                                    placeholder="Address">
                                @error('delivered_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <h5 class="form_title">Additional Details (Optional)</h5>
                            <div class="col-md-6">
                                <label for="no_of_packet" class="form-label">No. Of Packets </label>
                                <input type="number" class="form-control" name="no_of_packet" id="no_of_packet"
                                value="{{old('no_of_packet',$order->no_of_packet)}}"   placeholder="No. Of Packets">

                            </div>
                            <div class="col-md-6">
                                <label for="packet_weight" class="form-label">Packet Weight</label>
                                <input type="number" class="form-control" name="packet_weight" id="packet_weight"
                                value="{{old('packet_weight',$order->packet_weight)}}"   placeholder="Packet Weight">

                            </div>
                            <div class="col-md-6">
                                <label for="packet_width" class="form-label">Packet Width </label>
                                <input type="number" class="form-control" name="packet_width" id="packet_width"
                                value="{{old('packet_width',$order->packet_width)}}"   placeholder="Packet Width">
                            </div>
                            <div class="col-md-6">
                                <label for="packet_height" class="form-label">Packet Height </label>
                                <input type="number" class="form-control" name="packet_height" id="packet_height"
                                value="{{old('packet_height',$order->packet_height)}}"   placeholder="Packet Height">
                            </div><div class="col-md-6">
                                <label for="packet_length" class="form-label">Packet Lenght</label>
                                <input type="number" class="form-control" name="packet_length" id="packet_length"
                                value="{{old('packet_length',$order->packet_length)}}"   placeholder="Packet Lenght">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>
            </div><!-- End Recent Sales -->
        </div>
    </section>
@endsection
