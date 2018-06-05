<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\FileUploadController;
use App\Interfaces\ProjectEloquentInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectsApiController extends Controller
{
    /**
     * @var ProjectEloquentInterface
     */
    protected $projects;
    /**
     * @var FileUploadController
     */
    protected $uploads;

    /**
     * ProjectsController constructor.
     *
     * @param ProjectEloquentInterface $projects
     * @param FileUploadController $uploads
     */
    public function __construct(ProjectEloquentInterface $projects, FileUploadController $uploads)
    {
        $this->projects = $projects;
        $this->uploads = $uploads;
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = $this->projects->find($id);
        $files = $this->uploads->show($id);

        return response()->json([
            'data' => ['project' => $project, 'files' => $files]
        ], 200);
    }
}
