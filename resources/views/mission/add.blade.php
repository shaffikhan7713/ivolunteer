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
        <h5>Add Home Slider</h5>
        <form class="p-3" action="/admin/mission/add-update" method="POST" enctype="multipart/form-data"
            style="border: 1px solid;">
            @csrf
            <label><b>Slider Image (400 x 400):</b></label>
            <input type="file" name="image" class="form-control">
            <br>
            <input type="text" name="title" class="form-control">
            <br>
            <input type="text" name="description" class="form-control">
            <br>
            <button class="btn btn-primary">Submit</button>
            <a class="m-2" href="/admin/mission">Back</a>
        </form>
    </div>
</main>

<script>
$(document).ready(function() {});
</script>

@endsection