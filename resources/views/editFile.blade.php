@extends('template')

@section('judul', 'Edit File')

@section('konten')

<div class="card mt-3 mb-3">
    <div class="card-header">
        Edit File
    </div>
    <div class="card-body">
        <div class="mb-1">Old file name : {{ $file }}</div>
        <img src="{{ asset('storage/files/'.$file) }}" class="file-preview shadow-sm p-1 mb-2" height="300">
        <form action="/editFile" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            <input type="hidden" name="oldFile" value="{{ $file }}">
            <div class="row mb-4">
                <div class="col-10">
                    <label for="name">Choose File</label>
                    <input type="file" name="file" id="file" class="form-control" onchange="previewFile()" required>
                </div>
                <div class="col-2 mt-4">
                    <input type="submit" value="Save" class="btn btn-primary">
                    <a href="/file" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection