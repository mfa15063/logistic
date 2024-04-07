@extends('admin.layouts.main')
@section('content')
    <div class="pagetitle">
        <h1>Edit Inquiry</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href={{route('inquiry.index')}}>Inquiry</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <!-- Recent Sales -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Inquiry Details</h5>
                        <form class="row g-3" method="POST" action="{{route('inquiry.update',$inquery->id)}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="col-md-12">
                                <label for="name" class="form-label">Name<sup
                                    class="text-danger"><b>*</b></sup></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name',$inquery->name)}}" name="name" id="name"
                                    placeholder="Enter text of inquiry">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>
            </div><!-- End Recent Sales -->
        </div>
    </section>
@endsection
