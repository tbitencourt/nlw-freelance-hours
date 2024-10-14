<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Proposals extends Component
{
    const PROPOSALS_LIST_QUANTITY = 5;

    public Project $project;

    public int $quantity = self::PROPOSALS_LIST_QUANTITY;

    #[Computed]
    public function proposals(): Paginator
    {
        return $this->project->proposals()
            ->orderBy('hours')
            ->paginate($this->quantity);
    }

    #[Computed]
    public function lastProposalTime(): Carbon
    {
        return $this->project->proposals()->latest()->first()->updated_at;
    }

    public function loadMore(): void
    {
        $this->quantity += self::PROPOSALS_LIST_QUANTITY;

    }

    #[On('proposal::created')]
    public function render(): View
    {
        return view('livewire.projects.proposals');
    }
}
