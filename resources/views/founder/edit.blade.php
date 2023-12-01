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
        <h5>Edit Founder</h5>
        <form class="p-3" action="/admin/founder/add-update" method="POST" enctype="multipart/form-data"
            style="border: 1px solid;">
            @csrf
            <input type="text" name="name" class="form-control" placeholder="Enter name"
                value="{{ $founderDet['name'] }}">
            <br>
            <input type="text" name="role" class="form-control" placeholder="Enter founder role"
                value="{{ $founderDet['role'] }}">
            <br>
            <textarea name="bio" class="form-control">{{ $founderDet['bio'] }}</textarea>
            <br>
            <label><b>Founder Image (160 x 240):</b></label>
            <input type="file" name="image" class="form-control">
            <input type="hidden" name="id" value="{{ $founderDet['id']}}">
            <br>
            <img src="{{ url('uploads/founder/'.$founderDet['image']) }}" alt="Image" class="img-fluid tm-gallery-img"
                width="60" height="60" />
            <br />
            <button class="btn btn-primary">Submit</button>
            <a class="m-2" href="/admin/founder">Back</a>
        </form>
    </div>
</main>

<script>
$(document).ready(function() {});
</script>

@endsection