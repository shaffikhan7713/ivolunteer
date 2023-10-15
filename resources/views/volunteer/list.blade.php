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
        <h5>Volunteer List</h5>
        @if(count($volunteerLists) > 0)
        <table border="1" cellspacing="3" cellpadding="5">
            <thead>
                <th>Title</th>
                <th>Age</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($volunteerLists as $volunteer)
                <tr>
                    <td>{{ $volunteer->title }}</td>
                    <td>{{ $volunteer->age }}</td>
                    <td>{{ $volunteer->phone }}</td>
                    <td>{{ $volunteer->email }}</td>
                    <td><a href="{{ url('/admin/volunteer/'.$volunteer->id) }}">EDIT</a></td>
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