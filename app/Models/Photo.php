<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Photo extends Model
{
    use HasFactory,AsSource, Filterable;


    protected $fillable = [
      'title',
      'picture',
        'user_id'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function averageRating()
    {
        $totalRating = 0;
        $commentCount = 0;

        foreach ($this->comments as $comment) {
            if ($comment->score !== null) {
                $totalRating += $comment->score;
                $commentCount++;
            }
        }

        if ($commentCount > 0) {
            $averageRating = $totalRating / $commentCount;
            return number_format($averageRating, 1);
        } else {
            return 0;
        }
    }
}
