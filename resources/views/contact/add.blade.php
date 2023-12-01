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
        <h5>Add Founder</h5>
        <form class="p-3" action="/admin/founder/add-update" method="POST" enctype="multipart/form-data"
            style="border: 1px solid;">
            @csrf
            <input type="text" name="name" class="form-control" placeholder="Enter founder name" value="">
            <br>
            <input type="text" name="role" class="form-control" placeholder="Enter founder role" value="">
            <br>
            <textarea name="bio" class="form-control" placeholder="Enter Founder bio"></textarea>
            <br>
            <label><b>Founder Image (160 x 240):</b></label>
            <input type="file" name="image" class="form-control">
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