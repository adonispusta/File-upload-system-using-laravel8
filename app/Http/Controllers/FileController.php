<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use App\Services\Uploader\Uploader;
use Illuminate\Http\Request;

class FileController extends Controller
{

    private $uploader;

    public function __construct(Uploader $uploader)
    {

        $this->middleware('auth');
        $this->uploader = $uploader;

    }

    public function create()
    {
        return view('upload.create');
    }

    public function index()
    {
        $files = auth()->user()->files;
        return view('upload.index', compact('files'));
    }

    public function show(File $file)
    {

        return $file->download();
    }

    public function delete(File $file)
    {

        $file->delete();
        return redirect()->back();

    }



    public function store(Request $request)
    {

        $this->validateFile($request);
        try {
            $this->uploader->upload();
            return redirect()->back()->with('success', true);
        } catch (\Exception $exception) {
            $this->uploader->filePath();
            return redirect()->back()->with('fileAlreadyExists', 'File already exists at ' . $this->uploader->filePath());
        }

    }


    private function validateFile($request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimetypes:image/jpeg,video/mp4,application/zip'],
        ]);

    }
}
