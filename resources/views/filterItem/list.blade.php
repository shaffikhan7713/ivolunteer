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
        <h5>Filter Items List</h5>
        @if(count($filterItemLists) > 0)
        <table border="1" cellspacing="3" cellpadding="5">
            <thead>
                <th>ID</th>
                <th>Filter Name</th>
                <th>Filter Value</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($filterItemLists as $filterItem)
                <tr>
                    <td>{{ $filterItem->id }}</td>
                    <td>{{ $filterItem->filterName }}</td>
                    <td>{{ $filterItem->filterValue }}</td>
                    <td><a href="{{ url('/admin/filter-item/'.$filterItem->id) }}">EDIT</a></td>
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