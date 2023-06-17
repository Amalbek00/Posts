<?php

namespace App\Orchid\Layouts\Comment;

use App\Models\Comment;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CommentListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'comments';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('body', 'Text')
                ->sort()
                ->filter()
                ->render(fn(Comment $comment) => Link::make($comment->body)
                    ->route('platform.comments.edit', $comment)),
            TD::make('created_at', 'Created')
                ->render(fn(Comment $comment) => $comment->created_at->toDateTimeString())
                ->sort(),
            TD::make('updated_at', 'Last edit')
                ->render(fn(Comment $comment) => $comment->updated_at->toDateTimeString())
                ->sort(),
            TD::make('score', 'Score')
                ->render(fn(Comment $comment) => $comment->score)
                ->sort(),
        ];
    }
}
