@extends('layouts.main')

@section('main-section')

<main>
    <!-- <header class="row tm-welcome-section">
            <h2 class="col-12 text-center tm-section-title">Welcome to Simple House</h2>
            <p class="col-12 text-center">Total 3 HTML pages are included in this template. Header image has a parallax
                effect. You can feel free to download, edit and use this TemplateMo layout for your commercial or
                non-commercial websites.</p>
        </header> -->

    <!-- <div class="tm-paging-links p-3">
            <nav>
                <ul>
                    <li class="tm-paging-item"><a href="#" class="tm-paging-link active">Pizza</a></li>
                    <li class="tm-paging-item"><a href="#" class="tm-paging-link">Salad</a></li>
                    <li class="tm-paging-item"><a href="#" class="tm-paging-link">Noodle</a></li>
                </ul>
            </nav>
        </div> -->
    <section class="p-1">
        <div class="row">
            <div class="large-12 columns">
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <a href="/" target="_parent">
                            <img
                                src="https://cdn0.handsonconnect.org/0220/imagesResized/mobile/8323a801-e62d-4931-8805-8841ff7dd7d3.jpg" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="/" target="_parent">
                            <img
                                src="https://cdn0.handsonconnect.org/0220/imagesResized/mobile/018ec552-edfa-4d2b-b7cc-e2e2dff3c598.jpg" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="/" target="_parent">
                            <img
                                src="https://cdn0.handsonconnect.org/0220/imagesResized/mobile/ae20eda9-def8-497f-a559-f78699d4c949.jpg" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="/" target="_parent">
                            <img
                                src="https://cdn0.handsonconnect.org/0220/imagesResized/mobile/f05d06d8-e747-4773-a9fd-fc1ff83e2bc8.jpg" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="/" target="_parent">
                            <img src="https://cdn0.handsonconnect.org/00006c/imagesResized/mobile/CVP%20(58).png" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="/" target="_parent">
                            <img
                                src="https://cdn0.handsonconnect.org/00006c/imagesResized/mobile/Donation%20Drives_1080%20x%201080%20(45).png" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="/" target="_parent">
                            <img src="https://cdn0.handsonconnect.org/00006c/imagesResized/mobile/CVP%20(77).png" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="/" target="_parent">
                            <img src="https://cdn0.handsonconnect.org/00006c/imagesResized/mobile/CVP%20(82).png" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="/" target="_parent">
                            <img src="https://cdn0.handsonconnect.org/00006c/imagesResized/mobile/CVP%20(85).png" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="tm-section tm-container-inner btn-warning">
        <form id="opportunity-search-form" class="searchvo p-4 mb-3" action="" method="get">
            @csrf
            <h5 style="color: white; mb-2">Volunteer Opportunity Search</h5>
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control" placeholder="Enter to search"
                            aria-label="Enter to search" value="{{ $search }}" />
                    </div>

                </div>
                <div class="col-md-4">
                    <select class="form-select" name="location" aria-label="Default select example">
                        <option selected>Select Location</option>
                        <option {{ $location && $location === 'Austin' ? 'selected' : ''}} value="Austin">Austin
                        </option>
                        <option {{ $location && $location === 'Seattle' ? 'selected' : ''}} value="Seattle">Seattle
                        </option>
                        <option {{ $location && $location === 'Boston' ? 'selected' : ''}} value="Boston">Boston
                        </option>
                        <option {{ $location && $location === 'New York' ? 'selected' : ''}} value="New York">New
                            York</option>
                        <option {{ $location && $location === 'Chicago' ? 'selected' : ''}} value="Chicago">Chicago
                        </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w100">Search</button>
                </div>
                <div class="col-md-2">
                    <a href="/">Clear Filters</a>
                </div>
            </div>
        </form>
    </div>

    @if(count($volunteerLists) > 0)
    <div id="articles">
        @include('load')
    </div>
    @else
    <div class="row tm-gallery">
        <!-- gallery page 1 -->
        <div id="tm-gallery-page-pizza" class="tm-gallery-page">
            <p>No Records Found</p>
        </div>
    </div>
    @endif
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

<script>
function fetch_data(page) {
    $.ajax({
        url: "/pagination/fetch_data?page=" + page,
        type: 'POST',
        data: $('#opportunity-search-form').serialize()
    }).done(function(data) {
        $('#articles').html(data);
    }).fail(function() {
        alert('Articles could not be loaded.');
    });
}
$(document).ready(function() {
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        items: 4,
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true
    });

    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();

        /*$('#load a').css('color', '#dfecf6');
        $('#load').append(
            '<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/img/loading.gif" />'
        );*/

        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });
})
</script>
@endsection