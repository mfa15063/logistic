<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('admin/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('admin/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!--  CSS Files -->
    <link href="{{ asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!--  Main CSS File -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Author: Zeeshan Mushtaq
  ======================================================== -->
</head>

<body>
    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">Logistic</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login </h5>
                                        <p class="text-center small">Enter your email & password to login</p>
                                    </div>
                                    <form class="row g-3 needs-validation" method="POST"
                                        action="{{ route('login.auth') }}">
                                        @csrf
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" name="email" value="{{ old('email') }}"
                                                class="form-control @error('email') is-invalid @enderror @if (!$errors->has('email') && old('email')) is-valid @endif"
                                                id="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>

                                                <div class="input-group mb-3">
                                                    <input type="password" name="password"
                                                    class="form-control  @error('password') is-invalid @enderror @if (!$errors->has('password') && old('password')) is-valid @endif"
                                                    id="password">
                                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                        <i class="bi bi-eye" id="eyeIcon"></i>
                                                      </button>                                                  </div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!--  JS Files -->
    <script src="{{ asset('admin/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('admin/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('admin/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/php-email-form/validate.js') }}"></script>

    <!--  Main JS File -->
    <script src="{{ asset('admin/js/main.js') }}"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
          var passwordInput = document.getElementById('password');
          var eyeIcon = document.getElementById('eyeIcon');

          if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('bi','bi-eye');
            eyeIcon.classList.add('bi','bi-eye-slash');
          } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('bi','bi-eye-slash');
            eyeIcon.classList.add('bi','bi-eye');
          }
        });
      </script>
</body>

</html>
