@extends('admin.layouts.main')
@section('content')
    <div class="pagetitle">
        <h1>Create Client</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Client</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Recent Sales -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Enter Client Details</h5>
                        <form class="row g-3" method="POST" action="{{route('client.store')}}">
                            @csrf
                            <div class="col-md-6">
                                <label for="name" class="form-label">Client Name <sup
                                    class="text-danger"><b>*</b></sup></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" name="name" id="name"
                                    placeholder="Client Name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email <sup
                                    class="text-danger"><b>*</b></sup></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" name="email" id="email"
                                    placeholder="Email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phone_no" class="form-label">Phone No. <sup
                                    class="text-danger"><b>*</b></sup></label>
                                <input type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" id="phone_no"
                                    placeholder="Phone No." value="{{old('phone_no')}}">
                                    @error('phone_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="country" class="form-label">Country (Optional)</label>
                                <input type="text" class="form-control " value="{{old('country')}}" name="country" id="country"
                                    placeholder="Client Country">
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label">City (Optional)</label>
                                <input type="text" class="form-control " value="{{old('city')}}" name="city" id="address"
                                    placeholder="Client City">
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label">Address (Optional)</label>
                                <input type="text" class="form-control " value="{{old('address')}}" name="address" id="address"
                                    placeholder="Client Address">
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password <sup
                                    class="text-danger"><b>*</b></sup></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password"
                                    placeholder="Password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirm Password <sup
                                    class="text-danger"><b>*</b></sup></label>
                                <input type="password" class="form-control " name="password_confirmation" id="password_confirmation"
                                    placeholder="Confirm Password">
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
