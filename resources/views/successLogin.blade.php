@extends('template')

@section('judul','Success Login')

@section('konten')
    <div class="card mt-4">
        <div class="card-header">
            Dashboard | <a href="/logout" class="me-3">Logout</a>
        </div>
        <div class="card-body p-5">
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('message')}}<br>
                    {{-- <strong>Token </strong>{{session('token')}} --}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h2>Hello welcome, your login is successed...</h2>
        </div>
    </div>
@endsection