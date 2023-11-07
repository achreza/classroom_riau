<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Carter+One&display=swap" rel="stylesheet" />
    <title>IKTN Learning</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('image/logo.svg') }}" />
    <link rel="stylesheet" href="{{ asset('/style/login.css') }}" />

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
</head>

<body style="">
    <!-- Section: Design Block -->
    <section class="text-center text-lg-start">
        <style>
            .cascading-right {
                margin-right: -50px;
            }

            .bg-auth {
                background-repeat: no-repeat;
                background-size: cover;
                height: 100vh;

            }

            /* .card {
                margin-top: 80px;
            } */

            @media (max-width: 991.98px) {
                .cascading-right {
                    margin-right: 0;
                }
            }
        </style>

        <!-- Jumbotron -->
        <div class="bg-auth" style="background-image: url({{ asset('image/gedung2.jpg') }}); ">
            <div class="container py-4">
                <div class="row g-0 align-items-center">
                    <div class="col-lg-12 mb-5 mb-lg-0">
                        <div class="card "
                            style="
                        width: fit-content;
            background: hsla(0, 0%, 100%, 0.2);
            backdrop-filter: blur(5px); z-index: 3;
            ">
                            <div class="card-body p-5 shadow-5 text-center">

                                <img style="width: 240px; margin-bottom: 30px" src="{{ asset('image/logo2.png') }}"
                                    alt="">
                                <br>
                                <link rel="stylesheet" type="text/css"
                                    href="//fonts.googleapis.com/css?family=Open+Sans" />


                                <a href="{{ url('/auth/google') }}" class="btn-google">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg"
                                        alt="Google Icon">
                                    Login with Google
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-lg-6 mb-5 mb-lg-0">
                    <img src="{{ asset('image/gedung2.jpg') }}" class="w-100 rounded-4 shadow-4" alt="" />
                    <div class="card " style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div> --}}
                </div>
            </div>
        </div>

        <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>
