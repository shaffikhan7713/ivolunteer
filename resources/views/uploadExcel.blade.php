@extends('layouts.main')

@section('main-section')

<main>
    @include('adminMenu')
    <div class="container">
        <div class="card mt-3 mb-3">
            <div class="card-header text-center">
                <h4>Select Excel File To Upload</h4>
            </div>
            <div class="card-body">
                <form action="/import-excel" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="uploadExcel" id="uploadExcel" class="form-control">
                    <br>
                    <button class="btn btn-primary" id="btnUpload">Import Volunteer Data</button>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
$(document).ready(function() {
    $('#btnUpload').click(function() {
        if ($('#uploadExcel').val() === '') {
            alert("Please select excel file with valid data to upload");
            return false;
        }
    })

});
</script>

@endsection