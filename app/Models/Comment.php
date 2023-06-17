<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;

class Comment extends Model
{
    use HasFactory,AsSource, Filterable;

    /** @var string[] $fillable */
    protected $fillable = ['score', 'body', 'photo_id', 'user_id'];

    /**
     * @return BelongsTo
     */
    protected $allowedFilters = [
        'body' => Like::class
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'body',
        'updated_at',
        'created_at',
    ];


    public function photo(): BelongsTo
    {
        return $this->belongsTo(Photo::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
