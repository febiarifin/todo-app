@extends('template')

@section('judul','Login')

@section('konten')
    <div class="card mt-4">
        <div class="card-header">
            Login
        </div>
        <div class="card-body p-5">
            <form action="/auth" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" required>
                </div>
                <input type="submit" value="Login" class="btn btn-primary">
            </form>
            @if (session('invalid'))
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    {{session('invalid')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
@endsection