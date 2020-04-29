<?php

namespace App\Http\Controllers;

use App\Gambar;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload()
    {
        $gambar = Gambar::get();
        return view('upload', ['gambar' => $gambar]);
    }

    public function proses_upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'keterangan' => 'required',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');


        // nama file
        $nama_file = time() . "_" . $file->getClientOriginalName();
        /*echo 'File Name: ' . $file->getClientOriginalName();
        echo '<br>';*/

//        // ekstensi file
//        echo 'File Extension: ' . $file->getClientOriginalExtension();
//        echo '<br>';
//
//        // real path
//        echo 'File Real Path: ' . $file->getRealPath();
//        echo '<br>';
//
//        // ukuran file
//        echo 'File Size: ' . $file->getSize();
//        echo '<br>';
//
//        // tipe mime
//        echo 'File Mime Type: ' . $file->getMimeType();
//
//        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'data_file';
        $file->move($tujuan_upload, $nama_file);

        // upload file
//        $file->move($tujuan_upload, $file->getClientOriginalName());
        Gambar::create([
            'file' => $nama_file,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back();
    }
}
