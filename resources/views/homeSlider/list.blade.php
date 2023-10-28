@extends('layouts.main')

@section('main-section')

<main>
    @include('adminMenu')
    @if(session('success'))
    <h4 class="tm-text-success text-center mt-3">{{session('success')}}</h4>
    @endif

    @if(session('error'))
    <h4 class="tm-text-success text-center mt-3">{{session('error')}}</h4>
    @endif

    <div class="tm-section tm-container-inner mb-3 mt-4">
        <div class="row">
            <div class="col">
                <h5>Home Sliders List</h5>
            </div>
            <div class="col"><a href="/admin/home-sliders/add">Add New</a></div>
        </div>
        @if(count($homeSliderLists) > 0)
        <table border="1" cellspacing="3" cellpadding="5">
            <thead>
                <th>ID</th>
                <!-- <th>Slider Name</th> -->
                <th>Filter Value</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($homeSliderLists as $homeSlider)
                <tr>
                    <td>{{ $homeSlider->id }}</td>
                    <!-- <td>{{ $homeSlider->name }}</td> -->
                    <td><img src="{{ url('uploads/homesliderimages/'.$homeSlider['image']) }}" alt="Image"
                            class="img-fluid tm-gallery-img" width="60" height="60" /></td>
                    <td><a href="{{ url('/admin/home-sliders/'.$homeSlider->id) }}">EDIT</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>No Records Found</p>
        @endif
    </div>
</main>

<script>
$(document).ready(function() {});
</script>

@endsection