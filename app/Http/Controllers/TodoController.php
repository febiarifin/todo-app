<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{

    public function index()
    {
        try {
            $todos = Todo::all();
            $i = 0;
            return view('todo', ['todos' => $todos], ['i' => $i]);
        } catch (\Throwable $e) {
            report($e);
            return redirect('/')->with('danger', $e->getMessage());
        }
    }

    public function create(Request $request)
    {
        try {
            $request['status'] = "plan";
            Todo::create($request->all());
            return back()->with('success', 'Todo berhasil ditambahkan.');
        } catch (\Throwable $e) {
            report($e);
            return redirect('/todo')->with('danger', $e->getMessage());
        }
    }

    public function detailTodo($id)
    {
        try {
            $todo = DB::table('todos')->select('name')->where('id', $id)->get();
            $name = $todo[0];

            return view('editTodo', ['name' => $name], ['id' => $id]);
        } catch (\Throwable $e) {
            report($e);
            return redirect('/todo')->with('danger', 'Todo tidak ditemukan.');
        }
    }

    public function editValueTodo(Request $request)
    {
        try {
            DB::table('todos')->where('id', $request->id)->update(['name' => $request->name]);
            return redirect('/todo')->with('success', 'Todo berhasil diedit.');
        } catch (\Throwable $e) {
            report($e);
            return redirect('/todo')->with('danger', $e->getMessage());
        }
    }

    public function update($id, $status)
    {
        try {
            if ($status == 'plan') {
                $newStatus = "process";
                DB::table('todos')->where('id', $id)->update(['status' => $newStatus]);
                return back()->with('success', 'Todo dimulai.');
            } elseif ($status == 'process') {
                $newStatus = "done";
                DB::table('todos')->where('id', $id)->update(['status' => $newStatus]);
                return back()->with('success', 'Todo selesai.');
            }
        } catch (\Throwable $e) {
            report($e);
            return redirect('/todo')->with('danger', $e->getMessage());
        }
    }

    public function cancelTodo($id, $status)
    {
        try {
            if ($status == 'process') {
                $newStatus = "plan";
                DB::table('todos')->where('id', $id)->update(['status' => $newStatus]);
                return back()->with('success', 'Todo dijadwalkan.');
            } elseif ($status == 'done') {
                $newStatus = "process";
                DB::table('todos')->where('id', $id)->update(['status' => $newStatus]);
                return back()->with('success', 'Todo dimulai.');
            }
        } catch (\Throwable $e) {
            report($e);
            return redirect('/todo')->with('danger', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            DB::table('todos')->where('id', $id)->delete();
            return back()->with('success', 'Todo berhasil dihapus.');
        } catch (\Throwable $e) {
            report($e);
            return redirect('/todo')->with('danger', $e->getMessage());
        }
    }
}