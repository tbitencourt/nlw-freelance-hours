<?php

namespace App\Livewire\Proposals;

use App\Contracts\ArrangesProposalPositions;
use App\Models\Project;
use App\Models\Proposal;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
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
        DB::transaction(fn () => $this->saveProposal());
        $this->modal = false;
    }

    public function saveProposal(): void
    {
        /** @var Proposal $proposal */
        $proposal = $this->project->proposals()
            ->updateOrCreate(
                ['email' => $this->email],
                ['hours' => $this->hours]
            );
        $this->arrangePositions($proposal);
        $this->dispatch('proposal::created');
    }

    protected function arrangePositions(Proposal $proposal): void
    {
        $query = DB::select('
            SELECT *, ROW_NUMBER() OVER (ORDER BY hours) AS new_position
            FROM proposals
            WHERE project_id = :project
        ', ['project' => $proposal->project_id]);
        $newPosition = collect($query)->where('id', '=', $proposal->id)->first();
        $oldPosition = collect($query)->where('position', '=', $newPosition->new_position)->first();
        if ($oldPosition) {
            $proposal->updatePositionStatus($newPosition->new_position);
            $otherProposal = Proposal::query()->findOrFail($oldPosition->id);
            $otherProposal->updatePositionStatus($proposal->position);
            $this->getArrangeProposalsPositions()->arrange($proposal->project);
        }
    }

    protected function getArrangeProposalsPositions(): ArrangesProposalPositions
    {
        return $this->action ??= app(ArrangesProposalPositions::class);
    }

    public function render(): View
    {
        return view('livewire.proposals.create');
    }
}
