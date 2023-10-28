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
        <h5>Edit Filter Item</h5>
        <form class="p-3" action="/admin/filter-item/update" method="POST" style="border: 1px solid;">
            @csrf
            <label><b>{{ ucfirst($filterItemDet->filterName) }}:</b></label>
            <input type="text" name="filterValue" value="{{ $filterItemDet->filterValue }}" class="form-control">
            <input type="hidden" name="id" value="{{ $filterItemDet->id}}">
            <br>
            <button class="btn btn-primary">Submit</button>
            <a class="m-2" href="/admin/filter-items">Back</a>
        </form>
    </div>
</main>

<script>
$(document).ready(function() {});
</script>

@endsection