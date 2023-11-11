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
                <h5>Subscriptions List</h5>
            </div>
            <!-- <div class="col"><a href="/admin/subscription/add">Add New</a></div> -->
        </div>
        @if(count($subscriptions) > 0)
        <table border="1" cellspacing="3" cellpadding="5">
            <thead>
                <th>ID</th>
                <th>Email</th>
                <th>Filter Value</th>
                <!-- <th>Action</th> -->
            </thead>
            <tbody>
                @foreach($subscriptions as $subscription)
                <tr>
                    <td>{{ $subscription->id }}</td>
                    <td>{{ $subscription->email }}</td>
                    <td>{{ $subscription->filters }}</td>
                    <!-- <td><a href="{{ url('/admin/subscription/'.$subscription->id) }}">EDIT</a></td> -->
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