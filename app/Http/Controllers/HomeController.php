<?php

namespace App\Http\Controllers;

use App\Models\Project;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $projects = Project::get();
        return view('projects',  ['projects' => $projects]);
    }

    public function projects()
    {
        $projects = Project::get();
        return view('projects',  ['projects' => $projects]);
    }

    public function adminProjects()
    {
        $projects = Project::get();
        return view('adminProjects',  ['projects' => $projects]);
    }

}
