@extends('admin.layouts.main')
@section('style')
    <style>
        .long-text {
            max-width: 200px;
      overflow: hidden;
      /* text-overflow: ellipsis; Optional: adds ellipsis for overflowing text */
      white-space: wrap;
        }
    </style>
@endsection
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
                            <table class="table table-hover datatable" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Client ID</th>
                                        <th scope="col">Recived From</th>
                                        <th scope="col">Delivered To</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->user_id }}</td>
                                            <td>{{ $order->received_address }},{{ $order->received_city }},{{ $order->received_country }}
                                            </td>
                                            <td>{{ $order->delivered_address }},{{ $order->delivered_city }},{{ $order->delivered_country }}
                                            </td>
                                            <td>{{ $order->price }}</td>
                                            <td class="long-text">
                                                @if ($order->status == 'Pending')
                                                    <span class="badge  bg-secondary">{{ $order->status }}</span>
                                                @elseif ($order->status == 'New')
                                                    <span class="badge bg-info">{{ $order->status }}</span>
                                                @elseif ($order->status == 'Delivered')
                                                    <span class="badge bg-success">{{ $order->status }}</span>
                                                @elseif ($order->status == 'Rejected')
                                                    <span class="badge bg-danger">{{ $order->status }}</span>
                                                @else
                                                    <span class="badge bg-warning">{{ $order->status }}</span>
                                                @endif
                                            </td>
                                            <td class="long-text">
                                                @if ($order->approved == 0)
                                                    <a href="{{ route('order.updateApproved', $order->id) }}"
                                                        class="btn btn-sm btn-success mt-1">Accept </a>
                                                    <a href="{{ route('order.updateApproved', $order->id) }}"
                                                        class="btn btn-sm btn-danger mt-1">Reject</a>
                                                @elseif ($order->approved == 2)
                                                    <a href="{{ route('order.updateApproved', $order->id) }}"
                                                        class="btn btn-sm btn-success mt-1">Accept </a>
                                                @endif
                                                @if (!$order->order_delivered)
                                                    <a href="{{ route('order.updateDelivered', $order->id) }}"
                                                        class="btn btn-sm btn-success mt-1">Delivered</a>
                                                @else
                                                    <a href="{{ route('order.updateDelivered', $order->id) }}"
                                                        class="btn btn-sm btn-danger mt-1">Undelivered</a>
                                                @endif
                                                <a href="{{ route('order.edit', $order->id) }}"
                                                    class="btn btn-sm btn-success mt-1"><i
                                                        class="bi bi-pencil-square"></i></a>
                                                <button type="button" class="btn btn-info btn-sm mt-1"
                                                    data-bs-toggle="modal" data-bs-target="#modalview{{ $order->id }}">
                                                    <i class="bi bi-eye"></i> </button>
                                                <!-- Modal Body -->
                                                <div class="modal fade" id="modalview{{ $order->id }}" tabindex="-1"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                                    aria-labelledby="modalview{{ $order->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalview{{ $order->id }}">
                                                                    View Order
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <h5 class="mt-2 mb-2">Order ID:{{ $order->id }}
                                                                        </h5>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <h5 class="mt-2 mb-2">Client
                                                                            ID:{{ $order->user_id }} </h5>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <h5 class="mt-2 mb-2">Client
                                                                            Name:{{ $order->client->name }} </h5>
                                                                    </div>
                                                                    @if ($order->receiver_name)
                                                                        <div class="col-12">
                                                                            <h5 class="mt-2 mb-2">Recived
                                                                                Name:{{ $order->receiver_name }}
                                                                            </h5>
                                                                        </div>
                                                                    @endif
                                                                    <div class="col-12">
                                                                        <h5 class="mt-2 mb-2">Recived
                                                                            From:{{ $order->received_address }},{{ $order->received_city }},{{ $order->received_country }}
                                                                        </h5>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <h5 class="mt-2 mb-2">Delivered
                                                                            TO:{{ $order->delivered_address }},{{ $order->delivered_city }},{{ $order->delivered_country }}
                                                                        </h5>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <h5 class="mt-2 mb-2">Price:{{ $order->price }}
                                                                        </h5>
                                                                    </div>
                                                                    @if ($order->received_date)
                                                                        <div class="col-6">
                                                                            <h5 class="mt-2 mb-2">Received
                                                                                Date:{{ $order->received_date }}
                                                                            </h5>
                                                                        </div>
                                                                    @endif
                                                                    @if ($order->delivered_date)
                                                                        <div class="col-6">
                                                                            <h5 class="mt-2 mb-2">Delivered
                                                                                Date:{{ $order->delivered_date }}
                                                                            </h5>
                                                                        </div>
                                                                    @endif
                                                                    @if ($order->product_pic)
                                                                        <div class="col-12">
                                                                            <h5 class="mt-2 mb-2">Product Picture</h5>
                                                                            <img src="{{ asset($order->product_pic) }}"
                                                                                alt="">
                                                                        </div>
                                                                    @endif
                                                                    @if ($order->payment_recipt)
                                                                        <div class="col-12">
                                                                            <h5 class="mt-2 mb-2">Payment Recipt</h5>
                                                                            <img src="{{ asset($order->payment_recipt) }}"
                                                                                alt="">
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Close
                                                                </button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--delete Modal -->
                                                <button type="button" class="btn btn-danger btn-sm mt-1"
                                                    data-bs-toggle="modal" data-bs-target="#modalId">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                                <!-- Modal Body -->
                                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                <div class="modal fade" id="modalId" tabindex="-1"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                                    aria-labelledby="modaldelete{{ $order->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="modaldelete{{ $order->id }}">
                                                                    Delete Order
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">Are you sure you want to delete</div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('order.delete', $order->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        Close
                                                                    </button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Delete</button>
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
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No Order Found</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div><!-- End Recent Sales -->
        </div>
    </section>
@endsection
