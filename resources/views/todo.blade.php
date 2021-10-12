@extends('template')

@section('judul', 'Todo list')

@section('konten')

@if(session('success'))
<div class="alert alert-success mt-3" role="alert">
    {{session('success')}}
</div>
@endif

@if(session('danger'))
<div class="alert alert-danger mt-3" role="alert">
    {{session('danger')}}
</div>
@endif

<div class="card mt-3 mb-3">
    <div class="card-header">
        Add todo
    </div>
    <div class="card-body">
        <form action="/addTodo" method="POST">
            @csrf
            <div class="row g-2 mb-2">
                <div class="col-10 mt-4">
                    <label for="name">Todo Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-2 mt-5">
                    <input type="submit" value="Save" class="btn btn-primary">
                    <a href="/todo" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header">
        Todo list
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>NO</th>
                <th>TODO</th>
                <th>STATUS</th>
                <th>NOTED</th>
                <th>AKSI</th>
            </tr>
            @foreach($todos as $todo)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $todo->name }}</td>
                <td>
                    @if($todo->status=="plan")
                    <span class="badge rounded-pill bg-dark opacity-75">{{ $todo->status }}</span>
                    @elseif($todo->status=="process")
                    <span class="badge rounded-pill bg-primary opacity-75">{{ $todo->status }}</span>
                    @elseif($todo->status=="done")
                    <span class="badge rounded-pill bg-success opacity-75">{{ $todo->status }}</span>
                    @endif
                </td>
                <td>
                    @if($todo->status=='done')
                    <div class="shadow-sm p-1 bg-body rounded text-center">{{ $todo->updated_at }}</div>
                    @else
                    <div class="shadow-sm p-1 bg-body rounded text-center">Belum selesai</div>
                    @endif
                </td>
                <td>
                    @if($todo->status=="plan")
                    <a href="/editTodo/{{ $todo->id }}/{{ $todo->status }}" class="btn btn-secondary btn-sm">Start</a>
                    <a href="detailTodo/{{ $todo->id }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="deleteTodo/{{ $todo->id }}" class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin ingin dihapus ?');">Delete</a>
                    @elseif($todo->status=="process")
                    <a href="/editTodo/{{ $todo->id }}/{{ $todo->status }}" class="btn btn-success btn-sm">Done</a>
                    <a href="/cancelTodo/{{ $todo->id }}/{{ $todo->status }}" class="btn btn-danger btn-sm">Cancel</a>
                    @elseif($todo->status=="done")
                    <a href="/cancelTodo/{{ $todo->id }}/{{ $todo->status }}" class="btn btn-danger btn-sm">Cancel</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection