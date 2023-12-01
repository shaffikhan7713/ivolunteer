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
                <h5>Founders List</h5>
            </div>
            <div class="col"><a href="/admin/founder/add">Add New</a></div>
        </div>
        @if(count($founders) > 0)
        <table border="1" cellspacing="3" cellpadding="5">
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Bio</th>
                <th>Image</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($founders as $founder)
                <tr>
                    <td>{{ $founder->id }}</td>
                    <td>{{ $founder->name }}</td>
                    <td>{{ $founder->role }}</td>
                    <td>{{ $founder->bio }}</td>
                    <td><img src="{{ url('uploads/founder/'.$founder['image']) }}" alt="Image"
                            class="img-fluid tm-gallery-img" width="60" height="60" /></td>
                    <td><a href="{{ url('/admin/founder/'.$founder->id) }}">EDIT</a></td>
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