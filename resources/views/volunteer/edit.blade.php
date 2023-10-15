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
        <h5>Volunteer Edit</h5>
        <form class="p-3" action="/admin/volunteer/upload-image" method="POST" enctype="multipart/form-data"
            style="border: 1px solid;">
            @csrf
            <p>Title: <b>{{ $volunteerDet->title }}</b></p>

            <br>
            <p>Select main image file to upload (250 x 250)</p>
            <input type="file" name="mainImage" class="form-control">
            <input type="hidden" name="volunteerId" value="{{ $volunteerDet->id}}">
            <br>
            <button class="btn btn-primary">Submit</button>
        </form>

    </div>
</main>

<script>
$(document).ready(function() {});
</script>

@endsection