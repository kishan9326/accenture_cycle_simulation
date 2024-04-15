<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    use HasFactory;
    protected $fillable = [
        'player_id',
        'question_id',
        'is_correct',
        'calories',
        'timer', 
        'created_at',
        'updated_at',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
