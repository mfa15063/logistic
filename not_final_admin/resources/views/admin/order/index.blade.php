@extends('admin.layouts.main')
@section('content')
    <div class="pagetitle">
        <h1>View {{ $page }} Orders</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Order</a></li>
                <li class="breadcrumb-item active">{{ $page }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Recent Sales -->
            <div class="col-12">
                <div class="card recent-sales overflow-auto">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">Order<span></h5>
                            </div>
                            <div class="col-6 text-end mt-2"><a href="{{ route('order.create') }}"
                                    class="btn btn-primary">Create Order</a></div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Client ID</th>
                                        <th scope="col">Recived From</th>
                                        <th scope="col">Delivered To</th>
                                        <th scope="col">Reciver Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Reveived Date</th>
                                        <th scope="col">Delivered Date</th>
                                        <th scope="col">Approved</th>
                                        <th scope="col">Delivered</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->user_id }}</td>
                                            <td>{{ $order->received_address }},{{ $order->received_city }},{{ $order->received_country }}
                                            </td>
                                            <td>{{ $order->delivered_address }},{{ $order->delivered_city }},{{ $order->delivered_country }}
                                            </td>
                                            <td>{{ $order->receiver_name }}</td>
                                            <td>{{ $order->price }}</td>
                                            <td>{{ $order->received_date }}</td>
                                            <td>{{ $order->delivered_date }}</td>
                                            <td>{{ $order->approved ? 'Yes' : 'No' }}</td>
                                            <td>{{ $order->order_delivered ? 'Yes' : 'No' }}</td>
                                            <td>
                                                @if ($order->status == 'Pending')
                                                    <span class="badge  bg-warning">{{ $order->status }}</span>
                                                @elseif ($order->status == 'Delivered')
                                                    <span class="badge bg-success">{{ $order->status }}</span>
                                                @else
                                                    {{ $order->status }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($order->approved == 0)
                                                    <a href="{{ route('order.updateApproved', $order->id) }}"
                                                        class="btn btn-sm btn-success mt-1">Approve</a>
                                                    <a href="{{ route('order.updateApproved', $order->id) }}"
                                                        class="btn btn-sm btn-danger mt-1">Disapprove</a>
                                                @elseif ($order->approved == 1)
                                                    <a href="{{ route('order.updateApproved', $order->id) }}"
                                                        class="btn btn-sm btn-danger mt-1">Disapprove</a>
                                                @elseif ($order->approved == 2)
                                                    <a href="{{ route('order.updateApproved', $order->id) }}"
                                                        class="btn btn-sm btn-success mt-1">Approve</a>
                                                @endif
                                                @if (!$order->order_delivered)
                                                    <a href="{{ route('order.updateDelivered', $order->id) }}"
                                                        class="btn btn-sm btn-success mt-1">Delivered</a>
                                                @else
                                                    <a href="{{ route('order.updateDelivered', $order->id) }}"
                                                        class="btn btn-sm btn-danger mt-1">Undelivered</a>
                                                @endif
                                                <!-- Modal trigger button -->
                                                <button
                                                    type="button"
                                                    class="btn btn-danger btn-sm mt-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalId"
                                                >
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                                <!-- Modal Body -->
                                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                <div
                                                    class="modal fade"
                                                    id="modalId"
                                                    tabindex="-1"
                                                    data-bs-backdrop="static"
                                                    data-bs-keyboard="false"

                                                    role="dialog"
                                                    aria-labelledby="modaldelete{{$order->id}}"
                                                    aria-hidden="true"
                                                >
                                                    <div
                                                        class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                                        role="document"
                                                    >
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modaldelete{{$order->id}}">
                                                                    Delete Order
                                                                </h5>
                                                                <button
                                                                    type="button"
                                                                    class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"
                                                                ></button>
                                                            </div>
                                                            <div class="modal-body">Are you sure you want to delete</div>
                                                            <div class="modal-footer">
                                                                <form action="{{route('order.delete',$order->id)}}" method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                <button
                                                                    type="button"
                                                                    class="btn btn-secondary"
                                                                    data-bs-dismiss="modal"
                                                                >
                                                                    Close
                                                                </button>
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Optional: Place to the bottom of scripts -->
                                                <script>
                                                    const myModal = new bootstrap.Modal(
                                                        document.getElementById("modalId"),
                                                        options,
                                                    );
                                                </script>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div><!-- End Recent Sales -->
        </div>
    </section>
@endsection
