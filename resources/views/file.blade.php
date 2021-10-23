@extends('template')

@section('judul','Upload File')

@section('konten')
<div class="card mt-3 mb-3">
    <div class="card-header">
        Upload File
    </div>
    <div class="card-body">
        <img class="file-preview img-fluid mb-3 col-sm-3">
        <form action="/upload-file" method="POST" enctype="multipart/form-data">
            @csrf
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
<div class="card">
    <div class="card-header">
        File List
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>NO</th>
                <th>FILE</th>
                <th>FILE NAME</th>
                <th>AKSI</th>
            </tr>
            @foreach($files as $file)
            <tr>
                <td>{{ ++$i }}</td>
                <td><img src="{{ asset('storage/files/'.$file->file) }}" height="50" alt="Image">
                </td>
                <td>{{ $file->file }}</td>
                <td>
                    <a href="/detailFile/{{ $file->id }}/{{ $file->file }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="/deleteFile/{{ $file->id }}/{{ $file->file }}" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection