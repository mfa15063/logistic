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
        <h1>View All Inqueries</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Inquery</a></li>
                <li class="breadcrumb-item active">View</li>
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
                                <h5 class="card-title">Inquery<span></h5>
                            </div>
                            <div class="col-6 text-end mt-2"><a href="{{ route('inquery.create') }}"
                                    class="btn btn-primary">Create Inquery</a></div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless datatable" id="myTableDatatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inqueries as $inquery)
                                        <tr>
                                            <td>{{ $inquery->name }}</td>
                                            <td>
                                                <a href="{{ route('inquery.edit', $inquery->id) }}" class="btn btn-sm btn-success mt-1"><i
                                                        class="bi bi-pencil-square"></i></a>
                                                <!-- Modal trigger button -->
                                                <button type="button" class="btn btn-danger btn-sm mt-1"
                                                    data-bs-toggle="modal" data-bs-target="#modalId">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                                <!-- Modal Body -->
                                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                <div class="modal fade" id="modalId" tabindex="-1"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                                    aria-labelledby="modaldelete{{ $inquery->id }}" aria-hidden="true">
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
                                                                        <form action="{{ route('inquery.delete', $inquery->id) }}"
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
