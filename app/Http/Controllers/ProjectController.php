<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Interfaces\FileServiceInterface;

//use App\Http\Requests\QustionRequest;

class ProjectController extends Controller
{
    private $fileService;

    public function __construct(FileServiceInterface $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $per_page = $request->per_page;
        return Project::paginate($per_page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        try{
            //Log::debug($request->all());
            $data = $request->except(['logo', 'wallpaper']);
            DB::beginTransaction();
            $project = new Project;
            $project = $project->create($data);

            $logo = $this->fileService->uploadFiles($request->logo, $project, 'logos');
            $project->logo = $logo;
            $wallpaper = $this->fileService->uploadFiles($request->wallpaper, $project, 'wallpapers');
            $project->wallpaper = $wallpaper;
            $project->save();


            DB::commit();
            $response = $project;
            
        } catch(\Throwable $e){
            $response = $e;
            DB::rollback();
        }
        return $response;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return $project;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $project->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
    }
}
