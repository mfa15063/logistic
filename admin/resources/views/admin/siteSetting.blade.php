@extends('admin.layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Setting</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Setting</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">

                <div class="card">
                    <div class="card-body pt-3">
                        <div class=" profile-edit pt-3" id="">

                            <form method="POST" action="{{ route('admin.site_setting.update') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="text" class="form-control" id="email"
                                            value="{{ old('email', $site->email ?? '') }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="phone_no" class="col-md-4 col-lg-3 col-form-label">Phone No.</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="phone_no" type="text" class="form-control" id="phone_no"
                                            value="{{ old('phone_no', $site->phone_no ?? '') }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="whatsapp_no" class="col-md-4 col-lg-3 col-form-label">Whatsapp No.</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="whatsapp_no" type="text" class="form-control" id="whatsapp_no"
                                            value="{{ old('whatsapp_no', $site->whatsapp_no ?? '') }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="address" type="text" class="form-control" id="address"
                                            value="{{ old('address', $site->address ?? '') }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="location" class="col-md-4 col-lg-3 col-form-label">Location</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="location" type="text" class="form-control" id="location"
                                            value="{{ old('location', $site->location ?? '') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="facebook_profile" class="col-md-4 col-lg-3 col-form-label">Fackbook
                                        Profile</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="facebook_profile" type="text" class="form-control"
                                            id="facebook_profile"
                                            value="{{ old('facebook_profile', $site->facebook_profile ?? '') }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="instagram_profile" class="col-md-4 col-lg-3 col-form-label">Instagram
                                        Profile</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="instagram_profile" type="text" class="form-control"
                                            id="instagram_profile"
                                            value="{{ old('instagram_profile', $site->instagram_profile ?? '') }}">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form><!-- End Profile Edit Form -->

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
