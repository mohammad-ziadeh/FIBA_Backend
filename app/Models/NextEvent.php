<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NextEvent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'location',
        'start_date',
        'end_date',
        'image_url',
        'event_code'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];




    public function teams()
    {
        return $this->belongsToMany(Team::class, 'event_team', 'event_id', 'team_id');
    }


    public function matchups()
    {
        return $this->hasMany(Matchup::class, 'event_id');
    }
}
