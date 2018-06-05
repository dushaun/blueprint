<?php

namespace App\Http\Controllers;


use App\Http\Requests\FileUploadRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController
{
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $allFiles = Storage::allFiles();

        $files = collect($allFiles)->filter(function ($item) {
            if ($item !== '.gitignore') { return $item; }
        })->map(function ($item) {
            return $this->fileInfo($item);
        });

        return view('files.index', compact('files'));
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return Storage::files($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FileUploadRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FileUploadRequest $request)
    {
        $file       = $request->file('file');
        $project    = $request->input('project_id');

        $filename   = 'project-' . $project . '-photo-' . time() . '.' . $file->getClientOriginalExtension();

        if (!file_exists(storage_path('app/public/' . $project))) {
            Storage::makeDirectory($project, 0777, true);
        }

        $file->storeAs($project, $filename);

        return redirect()->back();
    }

    /**
     * Download the specified resource.
     *
     * @param Request $request
     * @return mixed
     */
    public function download(Request $request)
    {
        return Storage::download($request->input('file'));
    }

    /**
     * Return file content.
     *
     * @param $filePath
     * @return array
     */
    private function fileInfo($filePath)
    {
        $file = [];
        $file['name'] = $filePath;
        $file['size'] = number_format(Storage::size($filePath) / 1048576, 2) . ' MB';
        $file['last_modified'] = date('y-m-d h:i:s', Storage::lastModified($filePath));

        return $file;
    }
}