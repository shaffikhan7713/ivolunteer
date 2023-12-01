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
                <h5>Contact List</h5>
            </div>
            <!-- <div class="col"><a href="/admin/founder/add">Add New</a></div> -->
        </div>
        @if(count($contacts) > 0)
        <table border="1" cellspacing="3" cellpadding="5">
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <!-- <th>Phone</th> -->
                <!-- <th>Action</th> -->
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->message }}</td>
                    <!-- <td>{{ $contact->phone }}</td> -->
                    <!-- <td><a href="{{ url('/admin/contact/'.$contact->id) }}">EDIT</a></td> -->
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