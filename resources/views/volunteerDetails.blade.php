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

    <!-- <div class="tm-section tm-container-inner mt-3">
            <form id="opportunity-search-form" class="searchvo p-3 mb-3" action="/search" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter to search"
                                aria-label="Enter to search" value="" />
                        </div>

                    </div>
                    <div class="col-md-4">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select Location</option>
                            <option value="1">New York</option>
                            <option value="2">US</option>
                            <option value="3">UK</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-outline-primary w100">Search</button>
                    </div>
                </div>
            </form>
        </div> -->

    @if(session('success'))
    <h4 class="tm-text-success text-center mt-3">{{session('success')}}</h4>
    @endif

    @if(session('error'))
    <h4 class="tm-text-success text-center mt-3">{{session('error')}}</h4>
    @endif

    <div class="tm-section tm-container-inner mb-3 mt-4">
        <div class="row">
            <div class="col-md-8 bgcolor">
                <h5>Volunteer Details</h5>
                <h3>{{ $volunteerDetails['title'] }}</h3>
                <b>Short Summary: </b>
                <p>{{ $volunteerDetails['shortDescription'] }}</p>
                <b>Summary: </b>
                <p>{{ $volunteerDetails['summary'] }}</p>
                <b>Volunteer Role: </b>
                <p>{{ $volunteerDetails['whatVolunteerDoes'] }}</p>
                <b>Criteria: </b>
                <p>{{ $volunteerDetails['criteria'] }}</p>
                <b>Location: </b>
                <p>{{ $volunteerDetails['whereLocation'] }}</p>
                <b>How To Apply: </b>
                <p>{{ $volunteerDetails['howToApply'] }}</p>
                <b>Link: </b>
                <p>{{ $volunteerDetails['link'] }}</p>
                <b>Age: </b><span>{{ $volunteerDetails['age'] }}</span><br />
                <b>Email: </b><span>{{ $volunteerDetails['email'] }}</span><br />
                <b>Phone: </b><span>{{ $volunteerDetails['phone'] }}</span><br />
                <b>Date And Time: </b><span>{{ $volunteerDetails['dateAndTime'] }}</span><br />
            </div>
            <div class="col-md-4">
                <label>Share</label>
                <p class="pt-2 mb-4">
                    <!--{!! $link !!}-->
                    <!-- <img src={{ asset('/img/instagram.png') }} width="60" alt="Share on Instagram"
                        class="img-fluid cursorPointer" /> -->
                    <img src={{ asset('/img/discord2.png') }} width="60" alt="Share on Discord"
                        class="img-fluid discordIcon cursorPointer" />
                    <a href="{{ url('/fb/login')}}"><img src={{ asset('/img/facebook.png') }} width="60"
                            alt="Share on Facebook" class="img-fluid cursorPointer" /></a>
                    <a href="mailto:?subject={{ $volunteerDetails['title'] }}&amp;body=Check out this site {{ url('/product/'.$volunteerDetails['seoUri'].'/'.$volunteerDetails['id']) }}."
                        title="Share by Email">
                        <img src={{ asset('/img/send-mail.png') }} width="60" alt="Share by Email">
                    </a>

                </p>
                <label>Give Ratings</label>
                <div class="rating">
                    <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                    <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                    <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                    <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                    <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                </div>
                <form name="formRating" id="formRating" action="/post-rating" method="POST">
                    @csrf
                    <textarea name="comments" placeholder="Comments" class="form-control"
                        aria-label="With textarea"></textarea>
                    <input type="hidden" name="inputRating" id="inputRating" value="0" class="form-control">
                    <input type="hidden" name="volunteerId" value="{{ $volunteerDetails['id'] }}" class="form-control"
                        id="volunteerId">
                    <button class="btn btn-secondary btn-sm mt-2">Submit</button>
                </form>
                <label class="mt-3">Total Ratings ({{ $avgStars }} Stars)</label>
                <div class="d-flex flex-row align-items-center mt-2">
                    <p class="small text-muted mb-0">
                        <!-- <h4 class="mr-3">{{ $avgStars }}</h4> -->
                    <div {{ $avgStars >=1 ? 'class=clip-star-active' : 'class=clip-star'}}>
                    </div>
                    <div {{ $avgStars >=2 ? 'class=clip-star-active' : 'class=clip-star'}}>
                    </div>
                    <div {{ $avgStars >=3 ? 'class=clip-star-active' : 'class=clip-star'}}>
                    </div>
                    <div {{ $avgStars >=4 ? 'class=clip-star-active' : 'class=clip-star'}}>
                    </div>
                    <div {{ $avgStars >=5 ? 'class=clip-star-active' : 'class=clip-star'}}>
                    </div>
                    </p>
                </div>
                @if(count($ratings) > 0)
                <div class="row d-flex justify-content-center mt-4">
                    <label class="mb-1">Comments & Reviews ({{ $count }} Reviews)</label>
                    <div class="col">
                        <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                            <div class="card-body p-3">
                                @foreach($ratings as $rating)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <!-- <div class="d-flex flex-row align-items-center">
                                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(4).webp"
                                                        alt="avatar" width="25" height="25" />
                                                    <p class="small mb-0 ms-2">Martha</p>
                                                </div> -->
                                            <div class="d-flex flex-row align-items-center">
                                                <p class="small text-muted mb-0">
                                                <h4 class="mr-3">{{ $rating->starRating }}</h4>
                                                <div
                                                    {{ $rating->starRating >=1 ? 'class=clip-star-active' : 'class=clip-star'}}>
                                                </div>
                                                <div
                                                    {{ $rating->starRating >=2 ? 'class=clip-star-active' : 'class=clip-star'}}>
                                                </div>
                                                <div
                                                    {{ $rating->starRating >=3 ? 'class=clip-star-active' : 'class=clip-star'}}>
                                                </div>
                                                <div
                                                    {{ $rating->starRating >=4 ? 'class=clip-star-active' : 'class=clip-star'}}>
                                                </div>
                                                <div
                                                    {{ $rating->starRating >=5 ? 'class=clip-star-active' : 'class=clip-star'}}>
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                        <p>{{ $rating->comments }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <form name="formDiscord" id="formDiscord" action="/share-post-on-discord" method="POST">
                    @csrf
                    <input type="hidden" name="content" value="{{ $volunteerDetails['shortDescription'] }}"
                        class="form-control">
                </form>
            </div>
        </div>

        <!-- <div class="tm-section tm-container-inner">
        <div class="row">
            <div class="col-md-6">
                <figure class="tm-description-figure">
                    <img src={{ asset('/img/img-01.jpg') }} alt="Image" class="img-fluid" />
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
$(document).ready(function() {
    // Handle click on paging links
    $('.discordIcon').click(function(e) {
        var c = confirm('Are you sure you want to submit this post to Discord?');
        if (c) {
            $('#formDiscord').submit();
        }
    });

    $('.rating input').click(function(e) {
        $('#inputRating').val($(this).attr('value'));
    });

    $('#formRating').submit(function() {
        if ($('#inputRating').val() <= 0) {
            alert("Please rate to submit");
            return false;
        }
    });
});
</script>

@endsection