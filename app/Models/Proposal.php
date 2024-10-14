<?php

namespace App\Models;

use Database\Factories\ProposalFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $email
 * @property int $hours
 * @property int $position
 * @property string $position_status
 * @property int $project_id
 * @property Project $project
 */
class Proposal extends Model
{
    /** @use HasFactory<ProposalFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'hours',
        'position',
        'position_status',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function updatePositionStatus(int $newPosition): void
    {
        if ($this->position == $newPosition) {
            return;
        } elseif ($this->position > $newPosition) {
            $this->position_status = 'up';
        } elseif ($this->position < $newPosition) {
            $this->position_status = 'down';
        }
        $this->save();
    }
}
