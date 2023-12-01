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
                <h5>Our Mission List</h5>
            </div>
            <!-- <div class="col"><a href="/admin/mission/add">Add New</a></div> -->
        </div>
        @if(count($mission) > 0)
        <table border="1" cellspacing="3" cellpadding="5">
            <thead>
                <th>ID</th>
                <!-- <th>Title</th> -->
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($mission as $miss)
                <tr>
                    <td>{{ $miss->id }}</td>
                    <!-- <td>{{ $miss->title }}</td> -->
                    <td>{{ $miss->description }}</td>
                    <td><img src="{{ url('uploads/mission/'.$miss['image']) }}" alt="Image"
                            class="img-fluid tm-gallery-img" width="60" height="60" /></td>
                    <td><a href="{{ url('/admin/mission/'.$miss->id) }}">EDIT</a></td>
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