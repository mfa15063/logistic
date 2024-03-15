@extends('admin.layouts.main')
@section('style')
    <style>
    .long-text {
        max-width: 400px;
        min-width: 250px;
        white-space: normal !important;
        word-wrap: break-word;
    }
    tbody, td, tfoot, th, thead, tr {
        border-color: #3633336b;
        border-style: solid;
        border-width: 1px !important;
    }

    #myTableDatatable {
        border-collapse: collapse; /* Ensure borders are collapsed */
        border: 1px solid #3633336b; /* Set border properties */
    }
    .long-th {
        min-width: 67px !important;
        word-wrap: break-word;
        margin-top: 10px
    }
    .dataTables_filter {
        margin-bottom: 20px; /* Change the value according to your requirement */
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
                            <table class="table table-bordered table-hover mt-4" id="myTableDatatable">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="long-th">Order ID</th>
                                        <th scope="col" class="long-th">Client ID</th>
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
                                            <td class="">
                                                @if ($order->approved == 0 && $order->status == 'Pending')
                                                    <span  class="badge  bg-secondary">{{ $order->status }}</span>
                                                @elseif ($order->approved == 1 && $order->order_delivered == 1 && $order->status == 'Delivered')
                                                    <span class="badge bg-success">{{ $order->status }}</span>
                                                @elseif ($order->approved == 2 && $order->status == 'Rejected')
                                                    <span class="badge bg-danger">{{ $order->status }}</span>
                                                @else
                                                    @if (str_word_count($order->status) > 4)
                                                        <span class="long-text badge bg-info" style="max-width: 400px; min-width: 250px; white-space: normal !important; word-wrap: break-word;">{{ $order->status }}</span>
                                                    @else
                                                        <span class="badge bg-info">{{ $order->status }}</span>
                                                    @endif
                                                @endif
                                                <span type="button" class="btn btn-white text-info btn-sm mt-1"
                                                data-bs-toggle="modal" data-bs-target="#modalstatus{{ $order->id }}">
                                                <i class="bi bi-pencil-square"></i> </span>
                                            <!-- Modal Body -->
                                            <div class="modal fade" id="modalstatus{{ $order->id }}" tabindex="-1"
                                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                                aria-labelledby="modalview{{ $order->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalstatus{{ $order->id }}">
                                                                Update Order status
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{route('order.update_status',$order->id)}}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                        <div class="modal-body">
                                                            <label for=""></label>
                                                            <div class="mb-3">
                                                                <label for="status" class="form-label">Status</label>
                                                                <textarea class="form-control" name="status" id="status" rows="3">{{$order->status}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                            <button type="submit" class="btn btn-primary"
                                                                data-bs-dismiss="modal">
                                                                Update
                                                            </button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                            </td>
                                            <td class="long-text">
                                                @if ($order->approved != 1)
                                                    @if(!is_null($order->price))
                                                        <a href="{{ route('order.updateApproved', ['type'=>'accept','id'=>$order->id]) }}"
                                                            class="btn btn-sm btn-success mt-1">Accept </a>
                                                    @elseif(is_null($order->price))
                                                        <button type="button" class="btn btn-sm btn-success mt-1" data-bs-toggle="modal" data-bs-target="#updatePriceModal{{$order->id}}">
                                                            Accept
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="updatePriceModal{{$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Reject Order</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="{{route('order.updateApproved',['type'=>'accept','id'=>$order->id])}}" method="POST">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <label for="price" class="form-label">Price</label>
                                                                                <input type="text" class="form-control " name="price"  id="price"
                                                                                    placeholder="Price">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-danger">Reject</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                @elseif ($order->approved == 0)
                                                    <button type="button" class="btn btn-sm btn-danger mt-1" data-bs-toggle="modal" data-bs-target="#rejectionModal{{$order->id}}">
                                                        Reject
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="rejectionModal{{$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Reject Order</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{route('order.updateApproved',['type'=>'reject','id'=>$order->id])}}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <label for="rejection_reason" class="form-label">Reason for rejection</label>
                                                                            <input type="text" class="form-control " name="rejection_reason"  id="rejection_reason"
                                                                                placeholder="Reason for rejection">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Reject</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        </div>
                                                    </div>
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
                                                                    @if ($order->no_of_packet)
                                                                        <div class="col-6">
                                                                            <h5 class="mt-2 mb-2">No of Packet:{{ $order->no_of_packet }}
                                                                            </h5>
                                                                        </div>
                                                                    @endif
                                                                    @if ($order->packet_weight)
                                                                        <div class="col-6">
                                                                            <h5 class="mt-2 mb-2">Packet Weight:{{ $order->packet_weight }}
                                                                            </h5>
                                                                        </div>
                                                                    @endif
                                                                    @if ($order->packet_width)
                                                                        <div class="col-6">
                                                                            <h5 class="mt-2 mb-2">Packet Width:{{ $order->packet_width }}
                                                                            </h5>
                                                                        </div>
                                                                    @endif
                                                                    @if ($order->packet_height)
                                                                        <div class="col-6">
                                                                            <h5 class="mt-2 mb-2">Packet Height:{{ $order->packet_height }}
                                                                            </h5>
                                                                        </div>
                                                                    @endif
                                                                    @if ($order->packet_length)
                                                                        <div class="col-6">
                                                                            <h5 class="mt-2 mb-2">Packet Length:{{ $order->packet_length }}
                                                                            </h5>
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
