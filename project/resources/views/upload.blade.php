@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h2>Upload File</h2>

    <div id="notification" style="display: none;" class="alert alert-success"></div>
    <div id="notification-error" style="display: none;" class="alert alert-danger"></div>

    <form id="upload-form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Choose file</label>
            <input type="file" name="file" class="form-control" id="file">
            <span class="text-danger" id="file-error"></span>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Upload</button>
    </form>
</div>
@endsection
