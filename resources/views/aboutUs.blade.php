@extends('layouts.main')

@section('main-section')

<main>
    <header class="row tm-welcome-section">
        <h2 class="col-12 text-center tm-section-title">Welcome to Acrozzi</h2>
        <!-- <p class="col-12 text-center">Total 3 HTML pages are included in this template. Header image has a parallax
            effect. You can feel free to download, edit and use this TemplateMo layout for your commercial or
            non-commercial websites.</p> -->
    </header>
    <div class="tm-container-inner tm-persons">
        <div class="row">
            @if(count($founders) > 0)
            @foreach($founders as $found)
            <article class="col-lg-6">
                <figure class="tm-person">
                    <img src="{{ url('uploads/founder/'.$found->image) }}" alt="Image"
                        class="img-fluid tm-person-img" />
                    <figcaption class="tm-person-description">
                        <h4 class="tm-person-name">{{ $found->name }}</h4>
                        <p class="tm-person-title">{{ $found->role }}</p>
                        <p class="tm-person-about">{{ $found->bio }}</p>
                    </figcaption>
                </figure>
            </article>
            @endforeach
            @endif
        </div>
    </div>
</main>

@endsection