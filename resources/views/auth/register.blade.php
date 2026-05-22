<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel 11 Multi Auth - Register</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <!-- Bootstrap Icons (opsional, jika butuh ikon di kemudian hari) -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
        <style>
            body {
                background: linear-gradient(to right, hsl(152, 95%, 39%), hsl(152, 95%, 39%));
                font-family: 'Arial', sans-serif;
            }

            .card {
                border: none;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                background: #fff;
                border-radius: 1rem;
            }

            .btn-primary {
                background: hsl(152, 95%, 39%);
                border: none;
                transition: 0.3s;
            }

            .btn-primary:hover {
                background: hsl(152, 95%, 30%);
            }

            .form-control {
                border-radius: 10px;
                padding-left: 15px;
                height: calc(2.5rem + 2px);
            }

            .form-floating label {
                margin-left: 15px;
                pointer-events: none;
                transition: all 0.2s ease-in-out;
            }

            /* Jika ingin label berpindah posisi saat input diisi */
            .form-floating input:focus ~ label,
            .form-floating input:not(:placeholder-shown) ~ label {
                transform: translateY(-1.5rem) scale(0.85);
                color: hsl(152, 95%, 39%);
            }

            .d-grid button {
                border-radius: 10px;
            }

            hr {
                border-top: 1px solid rgba(0,0,0,0.1);
            }

            .link-secondary {
                color: hsl(152, 95%, 39%);
            }

            .link-secondary:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body class="bg-light">
        <section class="p-3 p-md-4 p-xl-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                        <div class="card border border-light-subtle">
                            <div class="card-body p-3 p-md-4 p-xl-5">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-5">
                                            <h4 class="text-center">Register Here</h4>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('account.processRegister') }}" method="POST">
                                    @csrf
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Navigo">
                                                <label for="name" class="form-label">Name</label>
                                                @error('name')
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com">
                                                <label for="email" class="form-label">Email</label>
                                                @error('email')
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="numeric" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" id="phone_number" placeholder="+62 / 082">
                                                <label for="phone_number" class="form-label">Phone Number</label>
                                                @error('phone_number')
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                                                <label for="password" class="form-label">Password</label>
                                                @error('password')
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-primary btn-lg py-3" type="submit">Register Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <hr>
                                        <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-2">
                                            <span>Already have an account?</span>
                                            <a href="{{ route('account.login') }}" class="link-secondary text-decoration-none">Click here to login</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Bootstrap JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>
