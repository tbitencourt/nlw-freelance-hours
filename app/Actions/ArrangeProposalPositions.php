<?php

declare(strict_types=1);

namespace App\Actions;

use App\Contracts\ArrangesProposalPositions;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ArrangeProposalPositions implements ArrangesProposalPositions
{
    public function arrange(Project $project): void
    {

        DB::update('
                    WITH ranked_proposals AS (
                        SELECT id, row_number() OVER (ORDER BY hours) AS p
                        FROM proposals
                        WHERE project_id = :project
                    )
                    UPDATE proposals
                    SET position = (SELECT p FROM ranked_proposals WHERE proposals.id = ranked_proposals.id)
                    WHERE project_id = :project
                ', ['project' => $project->id]);
    }
}
