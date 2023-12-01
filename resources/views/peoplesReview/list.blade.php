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
                <h5>Peoples Review List</h5>
            </div>
            <!-- <div class="col"><a href="/admin/pReview/add">Add New</a></div> -->
        </div>
        @if(count($pReview) > 0)
        <table border="1" cellspacing="3" cellpadding="5">
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Place</th>
                <th>Description</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($pReview as $pr)
                <tr>
                    <td>{{ $pr->id }}</td>
                    <td>{{ $pr->name }}</td>
                    <td>{{ $pr->place }}</td>
                    <td>{{ $pr->description }}</td>
                    <td><a href="{{ url('/admin/peoples-review/'.$pr->id) }}">EDIT</a></td>
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