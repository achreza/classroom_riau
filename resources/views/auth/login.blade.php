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
    <link rel="shortcut icon" type="image/png" href="{{ asset('image/logo.png') }}" />
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
            .btn-primary {
                background-color: #0d613f !important;
                border-color: #0d613f;
            }

            a {
                text-decoration: none;
            }

            .container-fluid {
                padding-top: 10px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .login-wrap {
                display: flex;

                border: 1px solid rgb(194, 194, 194);
                height: fit-content;
                width: fit-content;

                position: relative;
            }

            .image-wrap {
                width: 70vw;
                height: 95vh;
                background-position-x: -240px;
                background-size: cover;
                background-repeat: no-repeat;

            }

            .overlay {
                background-color: black;
                height: 95vh;
                opacity: 0.3;
            }

            .text-on-image {
                padding: 70px 20px 0 30px;
                width: 200px;
                top: 0;
                position: absolute;
                font-size: 20px;
                color: rgb(255, 255, 255);
                z-index: 10;
            }

            .text-on-image h1 {
                font-family: "Carter One", cursive;
                line-height: 50px;
            }

            .text-on-image p {
                font-family: "Courier New", Courier, monospace;
            }

            .login-img {
                height: 50vh;
            }

            .form-wrap {
                padding: 20px 30px 20px 60px;
                display: flex;
                flex-direction: column;
            }

            form {
                display: flex;
                flex-direction: column;
            }

            .username-field,
            .pass-field {
                width: 300px;
                height: 20px;
                border-left: 20px;
                border-right: 20px;
                border-top: 300px;
            }

            label {
                margin-bottom: 5px;
            }

            .submit-btn {
                width: 100px;
                height: 40px;
                border-color: rgb(255, 255, 255);
                border-radius: 30px;
                background-color: rgb(107, 107, 107);
                color: rgb(255, 255, 255);
                font-size: 16px;
                font-weight: 800;
            }

            .login-text {
                margin-bottom: 30px;
            }

            .btn-google:hover {
                color: white;
            }

            @media (max-width: 768px) {


                .login-wrap {
                    flex-direction: column-reverse;
                }

                .image-wrap {
                    display: none;
                }

                .text-on-image {
                    padding: 20px;
                    width: auto;
                    font-size: 16px;
                }

                .form-wrap {
                    padding: 20px;
                }

                .card {
                    width: 100%;
                }

                .submit-btn {
                    width: 100%;
                    margin-top: 10px;
                }

                .card-body {
                    padding: 0 !important;
                }

                .container-fluid {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }





            }
        </style>

        <!-- Jumbotron -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-sm-6">
                    <div class="login-wrap">
                        <div class="image-wrap" style="background-image: url({{ asset('image/gedung2.jpg') }}); ">
                            <div class="overlay"></div>

                        </div>
                        <div class="form-wrap">

                            <div class="card border-0"
                                style="
                        width: fit-content;background: hsla(0, 0%, 100%, 0.2);backdrop-filter: blur(5px); z-index: 3;">
                                <div class="card-body p-5 shadow-5 text-center">

                                    <img style="width: 240px; margin-bottom: 30px" src="{{ asset('image/logo2.png') }}"
                                        alt="" class="logo-login">
                                    <br>
                                    <link rel="stylesheet" type="text/css"
                                        href="//fonts.googleapis.com/css?family=Open+Sans" />


                                    <a href="{{ url('/auth/google') }}" class="btn-google">
                                        <img src="{{ asset('image/ggl.png') }}" style="width: 20px; margin-right: 10px"
                                            alt="Google
                                            Icon">
                                        Login with Google
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
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
