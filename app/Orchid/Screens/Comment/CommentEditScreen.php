<?php

namespace App\Orchid\Screens\Comment;

use App\Models\Comment;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class CommentEditScreen extends Screen
{
    /** @var string $name */
    public string $name = 'Comment create';

    /** @var string $description */
    public string $description = 'Comment form';

    /** @var bool $exists */
    protected bool $exists = false;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Comment $comment): iterable
    {
        $this->exists = $comment->exists;

        if ($this->exists) {
            $this->name = 'Comment Edit';
        }
        return compact('comment');
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Create comment')
                ->icon('pencil')
                ->method('save')
                ->canSee(!$this->exists),
            Button::make('Update')
                ->icon('note')
                ->method('save')
                ->canSee($this->exists),
            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists)
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('comment.body')
                    ->title('Text')
                    ->placeholder('Comments text')
                    ->help('Short comment text'),
                Relation::make('comment.user_id')
                    ->title('Author')
                    ->fromModel(User::class, 'name', 'id'),
                Relation::make('comment.photo_id')
                    ->title('Photo')
                    ->fromModel(Photo::class, 'id', 'id'),
                Input::make('comment.score')
                    ->title('Score')
                    ->placeholder('Comments score')
                    ->help('Short comment body'),
            ])
        ];
    }


    /**
     * @param Comment $comment
     * @param Request $request
     * @return RedirectResponse
     */
    public function save(Comment $comment, Request $request): RedirectResponse
    {
        $comment->fill($request->get('comment'))->save();

        Alert::info(sprintf(
            'You are successfully %s an comment',
            $this->exists ? 'updated' : 'created'
        ));
        return redirect()->route('platform.comments.list');
    }

    public function remove(Comment $comment): RedirectResponse
    {
        if ($comment->delete()) {
            Alert::info('You have successfully deleted the comment');
            return redirect()->route('platform.comments.list');
        }
        Alert::warning('An error has occurred');

        return redirect()->route('platform.comments.list', $comment);
    }
}
