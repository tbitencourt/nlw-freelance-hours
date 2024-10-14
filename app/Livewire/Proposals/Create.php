<?php

namespace App\Livewire\Proposals;

use App\Models\Project;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    public Project $project;

    public bool $modal = false;

    #[Rule(['required', 'email'])]
    public string $email = '';

    #[Rule(['required', 'integer', 'gt:0'])]
    public int $hours = 0;

    #[Rule(['required', 'bool', 'in:true,1'])]
    public bool $agree = false;

    public function save(): void
    {
        $this->validate();
        $this->project->proposals()
            ->updateOrCreate(
                ['email' => $this->email],
                ['hours' => $this->hours]
            );
        $this->modal = false;
    }

    public function render(): View
    {
        return view('livewire.proposals.create');
    }
}
