@extends('admin.layouts.main')
@section('content')
    <div class="pagetitle">
        <h1>Contact Us Send Mail</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href={{route('inquiry.index')}}>Contact Us</a></li>
                <li class="breadcrumb-item active">Send mail</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <!-- Recent Sales -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Compose Mail</h5>
                        <form class="row g-3" method="POST" action="{{route('contact_us.sendMail',$contactUs->id)}}" enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-12">
                                <label for="email" class="form-label">Email<sup
                                    class="text-danger"><b>*</b></sup></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email',$contactUs->email)}}" name="email" id="email"
                                    placeholder="Enter email which you want to send mail">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="subject" class="form-label">Subject<sup
                                    class="text-danger"><b>*</b></sup></label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror" value="{{old('subject',$contactUs->inquiry->name)}}" name="subject" id="subject"
                                    placeholder="Enter subject">
                                    @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="message" class="form-label">Message<sup
                                    class="text-danger"><b>*</b></sup></label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="message" cols="30" rows="5">
                                        {{old('message',$contactUs->message)}}</textarea>
                                    @error('message')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Send Mail</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>
            </div><!-- End Recent Sales -->
        </div>
    </section>
@endsection
