<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Player extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cat_id',
        'session_id',
        'gaming_mode',
        'environment',
        'player_count',
        'name',
        'email',
        'organization',
        'age',
        'gender',
        'userFile',
        'correct_answers',
        'player_status',
        'created_at',
        'updated_at'
    ];

    use Sortable;
    // public $sortable = ['id', 'session_id', 'environment', 'name', 'email', 'age', 'gender', 'cat_id', 'organization', 'calories', 'timer_in_sec', 'correct_answers', 'player_status', 'created_at'];

    public function leaderboards()
    {
        return $this->hasMany(Leaderboard::class);
    }

    public function category() {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function getRanking() {
        $collection = collect(Player::orderBy('correct_answers', 'DESC')->orderBy('timer_in_sec', 'ASC')->orderBy('calories', 'ASC')->orderBy('created_at', 'DESC')->get());
        $data       = $collection->where('id', $this->id);
        $value      = $data->keys()->first() + 1;
        return $value;
     }
}
