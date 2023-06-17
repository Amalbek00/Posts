<?php

namespace App\Orchid\Screens\Photo;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class PhotoEditScreen extends Screen
{
    /** @var string $name */
    public string $name = 'Photo title';

    /** @var string $description */
    public string $description =  'Photo picture';

    /** @var bool $exists */
    protected bool $exists = false;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Photo $photo): iterable
    {
        $this->exists = $photo->exists;

        if ($this->exists) {
            $this->title = 'Photo Edit';
        }
        return compact('photo');    }


    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Create photo')
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
        ];    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('photo.title')
                    ->title('Title')
                    ->placeholder('Photo title')
                    ->help('Short photo title'),
                Input::make('photo.picture')
                    ->title('picture')
                    ->placeholder('Photo picture')
                    ->help('Short photo picture'),
                Relation::make('photo.user_id')
                    ->title('Author')
                    ->fromModel(User::class, 'name', 'id'),

            ])
        ];
    }

    public function save(Photo $photo, Request $request): RedirectResponse
    {
        $photo->fill($request->get('photo'))->save();

        Alert::info(sprintf(
            'You are successfully %s an photo',
            $this->exists ? 'updated' : 'created'
        ));
        return redirect()->route('platform.photos.list');
    }

    public function remove(Photo $photo): RedirectResponse
    {
        if ($photo->delete()) {
            Alert::info('You have successfully deleted the photo');
            return redirect()->route('platform.photos.list');
        }
        Alert::warning('An error has occurred');

        return redirect()->route('platform.photos.list', $photo);
    }
}
