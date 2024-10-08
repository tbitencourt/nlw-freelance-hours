<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Proposals extends Component
{
    public Project $project;

    public function render(): View
    {
        return view('livewire.projects.proposals');
    }
}
