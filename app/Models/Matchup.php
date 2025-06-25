<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matchup extends Model
{
    protected $fillable = [
        'event_id', 'team_a_id', 'team_b_id', 'match_time', 'location', 'round'
    ];

    public function teamA() {
        return $this->belongsTo(Team::class, 'team_a_id');
    }

    public function teamB() {
        return $this->belongsTo(Team::class, 'team_b_id');
    }

    public function event() {
        return $this->belongsTo(NextEvent::class, 'event_id');
    }
}

