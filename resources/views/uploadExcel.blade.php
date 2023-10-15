@extends('layouts.main')

@section('main-section')

<div class="container p-0">
    <!-- Top box -->
    <!-- Logo & Site Name -->
    <div class="placeholder">
        <div class="row tm-header-inner">
            <div class="col-md-6 col-12">
                <img src="img/simple-house-logo.png" alt="Logo" class="tm-site-logo" />
                <div class="tm-site-text-box">
                    <h1 class="tm-site-title">i Volunteer</h1>
                    <h6 class="tm-site-description">Your efforts can change lives</h6>
                </div>
            </div>
            <nav class="col-md-6 col-12 tm-nav">
                <ul class="tm-nav-ul">
                    <li class="tm-nav-li"><a href="index.html" class="tm-nav-link active">Home</a></li>
                    <li class="tm-nav-li"><a href="about.html" class="tm-nav-link">About</a></li>
                    <li class="tm-nav-li"><a href="contact.html" class="tm-nav-link">Contact</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <main>
        <!-- <header class="row tm-welcome-section">
            <h2 class="col-12 text-center tm-section-title">Welcome to Simple House</h2>
            <p class="col-12 text-center">Total 3 HTML pages are included in this template. Header image has a parallax
                effect. You can feel free to download, edit and use this TemplateMo layout for your commercial or
                non-commercial websites.</p>
        </header> -->

        <div class="tm-paging-links p-3">
            <nav>
                <ul>
                    <li class="tm-paging-item"><a href="#" class="tm-paging-link active">Pizza</a></li>
                    <li class="tm-paging-item"><a href="#" class="tm-paging-link">Salad</a></li>
                    <li class="tm-paging-item"><a href="#" class="tm-paging-link">Noodle</a></li>
                </ul>
            </nav>
        </div>

        <div class="container">
            <div class="card mt-3 mb-3">
                <div class="card-header text-center">
                    <h4>Select Excel File To Upload</h4>
                </div>
                <div class="card-body">
                    <form action="/import-excel" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="uploadExcel" class="form-control">
                        <br>
                        <button class="btn btn-primary">Import Volunteer Data</button>
                    </form>

                </div>
            </div>
        </div>



        <!-- Gallery -->
        <!-- <div class="tm-section tm-container-inner">
            <div class="row">
                <div class="col-md-6">
                    <figure class="tm-description-figure">
                        <img src="img/img-01.jpg" alt="Image" class="img-fluid" />
                    </figure>
                </div>
                <div class="col-md-6">
                    <div class="tm-description-box">
                        <h4 class="tm-gallery-title">Maecenas nulla neque</h4>
                        <p class="tm-mb-45">Redistributing this template as a downloadable ZIP file on any template
                            collection site is strictly prohibited. You will need to <a rel="nofollow"
                                href="https://templatemo.com/contact">talk to us</a> for additional permissions about
                            our templates. Thank you.</p>
                        <a href="about.html" class="tm-btn tm-btn-default tm-right">Read More</a>
                    </div>
                </div>
            </div>
        </div> -->
    </main>

    @endsection