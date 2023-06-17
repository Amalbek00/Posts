<?php

namespace App\Http\Form;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoForm extends Form
{

    /**
     * @param Request $request
     * @return mixed
     */
    protected function handle(Request $request)
    {
        $data = $request->all();
        $file = $request->file('picture');

        if (!is_null($file)){
            $data['picture'] = $file->store('pictures', 'public');
        }

        return Photo::create($data);
    }
}
