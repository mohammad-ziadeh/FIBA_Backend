<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'team_id', 'role'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function events()
    {
        return $this->belongsToMany(NextEvent::class, 'player_event', 'player_id', 'event_id')
            ->withPivot('points')
            ->withTimestamps();
    }
}
