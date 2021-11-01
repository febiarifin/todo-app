<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Files;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    public function index()
    {
        try {
            $files = Files::all();
            $i = 0;
            return view('file', ['files' => $files], ['i' => $i]);
        } catch (\Throwable $e) {
            report($e);
            return redirect('/')->with('danger', $e->getMessage());
        }
    }

    public function upload(Request $request)
    {
        try {
            $validateData = $request->validate([
                'file' => 'mimes:jpg,png|max:2048'
            ]);

            $file = new Files();

            if ($request->hasFile('file')) {
                $nameFileExt = $request->file('file')->getClientOriginalName();
                $nameFile = pathinfo($nameFileExt, PATHINFO_FILENAME);
                $extension = $request->file('file')->getClientOriginalExtension();
                $fileNameSave = $nameFile . '' . uniqid() . '.' . $extension;
            } else {
                $fileNameSave = 'noimage.png';
            }

            // Save file to Storage/app/public/files
            $path = $request->file('file')->storeAs('files', $fileNameSave);

            // Save name file to database
            $file->file = $fileNameSave;
            $file->save();

            return redirect('/file')->with('success', 'FIle berhasil disimpan');
        } catch (\Throwable $e) {
            return redirect('/file')->with('danger', $e->getMessage());
        }
    }

    public function detailFile($id, $file)
    {
        try {
            return view('editFile', ['file' => $file], ['id' => $id]);
        } catch (\Throwable $e) {
            report($e);
            return redirect('/file')->with('danger', 'File tidak ditemukan.');
        }
    }

    public function edit(Request $request)
    {
        try {
            $request->validate([
                'file' => 'mimes:jpg,png|max:2048'
            ]);

            if ($request->hasFile('file')) {
                //Delete file from Storage/app/public/files 
                Storage::delete('files/' . $request->oldFile);

                $nameFileExt = $request->file('file')->getClientOriginalName();
                $nameFile = pathinfo($nameFileExt, PATHINFO_FILENAME);
                $extension = $request->file('file')->getClientOriginalExtension();
                $fileNameSave = $nameFile . '' . uniqid() . '.' . $extension;

                // Save file to Storage/app/public/files
                $request->file('file')->storeAs('files', $fileNameSave);
            } else {
                $fileNameSave = 'noimage.png';
            }
            // Update
            DB::table('files')->where('id', $request->id)->update(['file' => $fileNameSave]);

            return redirect('/file')->with('success', 'FIle berhasil diedit');
        } catch (\Throwable $e) {
            report($e);
            return redirect('/file')->with('danger', 'File gagal disimpan.');
        }
    }

    public function delete($id, $file)
    {
        try {
            Storage::delete('files/' . $file);
            // File::delete($file);
            DB::table('files')->where('id', $id)->delete();
            return back()->with('success', 'File berhasil dihapus.');
            // dd($id, $file);
        } catch (\Throwable $e) {
            report($e);
            return redirect('/file')->with('danger', $e->getMessage());
        }
    }
}