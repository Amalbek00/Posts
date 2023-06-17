<?php

namespace App\Orchid\Layouts\Photo;

use App\Models\Photo;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PhotoListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'photos';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', 'Title')
                ->sort()
                ->filter()
                ->render(fn(Photo $photo) => Link::make($photo->title)
                    ->route('platform.photos.edit', $photo)),
            TD::make('created_at', 'Created')
                ->render(fn(Photo $photo) => $photo->created_at->toDateTimeString())
                ->sort(),
            TD::make('updated_at', 'Last edit')
                ->render(fn(Photo $photo) => $photo->updated_at->toDateTimeString())
                ->sort(),
        ];    }
}
