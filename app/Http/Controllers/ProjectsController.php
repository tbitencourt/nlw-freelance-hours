<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Contracts\View\View;

class ProjectsController extends Controller
{
    public function index(): View
    {
        return view('projects.index');
    }

    public function show(Project $project): View
    {
        return view('projects.show', compact('project'));
    }
}
