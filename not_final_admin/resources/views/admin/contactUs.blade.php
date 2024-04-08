@extends('admin.layouts.main')
@section('style')
    <style>
    .long-text {
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
<x-model></x-model>
    <div class="pagetitle">
        <h1>View All Contact Us</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('client.index')}}">Contact US</a></li>
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
                            <div class="col-12">
                                <h5 class="card-title">Contact Us<span></h5>
                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless datatable" id="myTableDatatable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="long-th">Client ID</th>
                                        <th scope="col" class="long-th">Inquiry</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Company Name</th>
                                        <th scope="col" class="long-th">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contactUses as $contactUs)
                                        <tr>
                                            <td>{{ $contactUs->client_id }}</td>
                                            <td>{{ $contactUs->inquiry->name }}</td>
                                            <td>{{ $contactUs->first_name }}</td>
                                            <td>{{ $contactUs->last_name }}</td>
                                            <td>{{ $contactUs->email }}</td>
                                            <td>{{ $contactUs->company_name }}</td>
                                            </td>
                                            <td>
                                                <!-- Modal trigger button -->
                                                <button type="button" class="btn btn-danger btn-sm mt-1"
                                                    data-bs-toggle="modal" data-bs-target="#modalId{{ $contactUs->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                                <!-- Modal Body -->
                                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                <div class="modal fade" id="modalId{{ $contactUs->id }}" tabindex="-1"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                                    aria-labelledby="modaldelete{{ $contactUs->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                                        role="document">

                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="text-center">
                                                                    <span class="success-icon py-3 px-3">
                                                                        <i style="font-size: 80px;color:#ff0000ad;" class="bi bi-x-circle"></i>
                                                                        </span>
                                                                </div>
                                                                <div class="text-center my-2 mb-2">
                                                                    <h3 class="model_title">
                                                                        Are you sure you want to delete
                                                                    </h3>
                                                                        <form action="{{ route('contact_us.delete', $contactUs->id) }}"
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
                                                </div>
                                                <!-- Modal trigger button -->
                                                <button type="button" class="btn btn-info btn-sm mt-1"
                                                data-bs-toggle="modal" data-bs-target="#modalIdview{{ $contactUs->id }}">
                                                <i class="bi bi-eye"></i> </button>
                                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                <div class="modal fade" id="modalIdview{{ $contactUs->id }}" tabindex="-1"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                                    aria-labelledby="modaldeletee{{ $contactUs->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <h2><b>Personal Information</b></h2>
                                                                    <div class="col-12">
                                                                        <h5 class="mt-2 mb-2">Client ID:{{ $contactUs->client_id }}</h5>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <h5 class="mt-2 mb-2">Inquiry:{{ $contactUs->inquiry->name }}</h5>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <h5 class="mt-2 mb-2">Name:{{ $contactUs->first_name }} {{ $contactUs->last_name }}</h5>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <h5 class="mt-2 mb-2">Email:{{ $contactUs->email }}</h5>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <h5 class="mt-2 mb-2">Phone Number:{{ $contactUs->email }}</h5>
                                                                    </div>
                                                                    <h2><b>Company Information</b></h2>
                                                                    <div class="col-12">
                                                                        <h5 class="mt-2 mb-2">Company Name:{{ $contactUs->company_name }}</h5>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <h5 class="mt-2 mb-2">Company URL:{{ $contactUs->company_url }}</h5>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <h5 class="mt-2 mb-2">Company Address:{{ $contactUs->company_address}}, {{ $contactUs->company_city}},{{ $contactUs->company_country}}</h5>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <h5 class="mt-2 mb-2">Message:{{ $contactUs->message}}</h5>
                                                                    </div>
                                                                </div>
                                                                <div class="text-center my-2 mb-2">
                                                                    <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">
                                                                                Close
                                                                            </button>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <a href="{{route('contact_us.compose',$contactUs->id)}}" class="btn btn-sm btn-primary  mt-1"><i class="bi bi-envelope"></i></a>

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
