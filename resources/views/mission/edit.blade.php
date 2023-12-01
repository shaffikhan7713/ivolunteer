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
        <h5>Edit our mission</h5>
        <form class="p-3" action="/admin/mission/add-update" method="POST" enctype="multipart/form-data"
            style="border: 1px solid;">
            @csrf
            <!-- <input type="text" name="title" class="form-control" placeholder="Enter title"
                value="{{ $mission['title'] }}"> -->
            <br>
            <textarea name="description" class="form-control">{{ $mission['description'] }}</textarea>
            <br>
            <label><b>Mission Image (400 x 400):</b></label>
            <input type="file" name="image" class="form-control">
            <input type="hidden" name="id" value="{{ $mission->id}}">
            <br>
            <img src="{{ url('uploads/mission/'.$mission['image']) }}" alt="Image" class="img-fluid tm-gallery-img"
                width="60" height="60" />
            <br />
            <button class="btn btn-primary">Submit</button>
            <a class="m-2" href="/admin/mission">Back</a>
        </form>
    </div>
</main>

<script>
$(document).ready(function() {});
</script>

@endsection