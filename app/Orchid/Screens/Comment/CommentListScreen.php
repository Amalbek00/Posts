<?php

namespace App\Orchid\Screens\Comment;

use App\Http\Controllers\CommentsController;
use App\Models\Comment;
use App\Orchid\Layouts\Comment\CommentListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class CommentListScreen extends Screen
{
    /**
     * @var string $name
     */
    public string $name = 'Comment Create';

    /**
     * @var string $description
     */
    public string $description = 'All comments';

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'comments' => Comment::filters()->defaultSort('id')->paginate()
        ];
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.comments.create')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            CommentListLayout::class
        ];
    }
}
