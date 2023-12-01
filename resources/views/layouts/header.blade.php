<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Acrozzi - Volunteering Platform</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('css/templatemo-style.css') }}" rel="stylesheet">
    <link href="{{ asset('owlcarousel/owlcss/owl.carousel.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.css"
        integrity="sha512-itF/9I/NigY9u4ukjw9s7/kG6SC7LJ5Q4pRNMnTbGZAsO4/RSUelfVuYBk8AkSk23qEcucIqdUlzzpy2qf7jGg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('owlcarousel/owl.carousel.js') }}"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script> -->

</head>
<!--

Simple House

https://templatemo.com/tm-539-simple-house

-->

<body>
    <div class="container p-0">
        <div class="placeholder">
            <div class="row tm-header-inner">
                <div class="col-md-6 col-12 cursorPointer">
                    <a href="/"><img src="{{ asset('/img/simple-house-logo.png') }}" alt="Logo"
                            class="tm-site-logo" /></a>
                    <div class="tm-site-text-box">
                        <h1 class="tm-site-title">Acrozzi</h1>
                        <h6 class="tm-site-description">Your efforts can change lives </h6>
                    </div>
                </div>
                <nav class="col-md-6 col-12 tm-nav">
                    <ul class="tm-nav-ul">
                        <li class="tm-nav-li"><a href="/"
                                class="tm-nav-link {{ Request::segment(1) == '' ? 'active' : '' }}">Home</a></li>
                        <li class="tm-nav-li"><a href="/about-us"
                                class="tm-nav-link {{ Request::segment(1) == 'about-us' ? 'active' : '' }}">About</a>
                        </li>
                        <li class="tm-nav-li"><a href="/contact-us"
                                class="tm-nav-link {{ Request::segment(1) == 'contact-us' ? 'active' : '' }}">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>