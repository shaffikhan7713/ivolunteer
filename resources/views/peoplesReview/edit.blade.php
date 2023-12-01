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
        <h5>Edit Peoples Review</h5>
        <form class="p-3" action="/admin/peoples-review/add-update" method="POST" enctype="multipart/form-data"
            style="border: 1px solid;">
            @csrf
            <label><strong>Name:</strong></label>
            <input type="text" name="name" class="form-control" placeholder="Enter name" value="{{ $pReview['name'] }}">
            <br>
            <label><strong>Place:</strong></label>
            <input type="text" name="place" class="form-control" placeholder="Enter place"
                value="{{ $pReview['place'] }}">
            <br>
            <label><strong>Description:</strong></label>
            <textarea name="description" class="form-control">{{ $pReview['description'] }}</textarea>
            <br>
            <input type="hidden" name="id" value="{{ $pReview->id}}">
            <br>
            <button class="btn btn-primary">Submit</button>
            <a class="m-2" href="/admin/peoples-review">Back</a>
        </form>
    </div>
</main>

<script>
$(document).ready(function() {});
</script>

@endsection