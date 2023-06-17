<?php

namespace App\Orchid\Screens\Photo;

use App\Models\Photo;
use App\Orchid\Layouts\Photo\PhotoListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class PhotoListScreen extends Screen
{
    /**
     * @var string $name
     */
    public string $name = 'Photo Create';

    /**
     * @var string $description
     */
    public string $description = 'All photos';
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'photos' => Photo::filters()->defaultSort('id')->paginate()
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
                ->route('platform.photos.create')
        ];    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            PhotoListLayout::class
        ];
    }
}
