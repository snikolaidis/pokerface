<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Upload;

class FileController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function store(Request $request)
    {
        return back()->with('message', 'Your file is submitted Successfully');

    }
    
    public function upload(Request $request)
    {
        $uploadedFile = $request->file('file');
        dd($uploadedFile);
    }

}
