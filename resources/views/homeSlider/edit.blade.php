@extends('layouts.main')

@section('main-section')

<main>
    @if(session('success'))
    <h4 class="tm-text-success text-center mt-3">{{session('success')}}</h4>
    @endif

    @if(session('error'))
    <h4 class="tm-text-success text-center mt-3">{{session('error')}}</h4>
    @endif

    <div class="tm-section tm-container-inner mb-3 mt-4">
        <h5>Edit Home Slider</h5>
        <form class="p-3" action="/admin/home-sliders/add-update" method="POST" enctype="multipart/form-data"
            style="border: 1px solid;">
            @csrf
            <label><b>Slider Image:</b></label>
            <input type="file" name="image" class="form-control">
            <input type="hidden" name="id" value="{{ $homeSliderDet->id}}">
            <br>
            <img src="{{ url('uploads/homesliderimages/'.$homeSliderDet['image']) }}" alt="Image"
                class="img-fluid tm-gallery-img" width="60" height="60" />
            <br />
            <button class="btn btn-primary">Submit</button>
            <a class="m-2" href="/admin/home-sliders">Back</a>
        </form>
    </div>
</main>

<script>
$(document).ready(function() {});
</script>

@endsection