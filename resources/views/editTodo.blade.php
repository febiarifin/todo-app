@extends('template')

@section('judul', 'Edit Todo')

@section('konten')

<div class="card mt-3 mb-3">
    <div class="card-header">
        Edit todo
    </div>
    <div class="card-body">
        <form action="/editValueTodo" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            <div class="row g-2 mb-2">
                <div class="col-10 mt-4">
                    <label for="name">Todo Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $name->name }}" required>
                </div>
                <div class="col-2 mt-5">
                    <input type="submit" value="Save" class="btn btn-primary">
                    <a href="/todo" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection