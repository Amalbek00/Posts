<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CommentsController extends Controller
{
    /**
     * @param Request $request
     * @param Photo $photo
     *
     */
    public function store(Request $request, Photo $photo, Comment $comment)
    {
        $request->validate([
            'body' => 'not_regex:/<[a-z][\s\S]*>/|required|string',
            'score' => 'required|integer|min:1|max:5'
        ]);

        $comment->body = $request->input('body');
        $comment->score = $request->input('score');
        $comment->user()->associate($request->user());
        $comment->photo_id = $photo->id;
        $comment->save();

        return redirect()->back()->with(['status' => 'Your comment added successfully']);

    }

    public function destroy(Photo $photo, Comment $comment)
    {

        $comment->delete();

        return redirect()->route('photos.show', ['photo' => $photo])
            ->with('status', "Successfully deleted");

    }
}
