<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public function render(): View
    {
        return view('livewire.projects.index');
    }

    #[Computed]
    public function projects(): Collection
    {
        return Project::query()->inRandomOrder()->get();
    }
}
