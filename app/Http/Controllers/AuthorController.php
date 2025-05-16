<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // -use UploadFile;

    public function index()
    {
        $authors = Author::orderBy('name')
            ->search(request('searchContext'), request('searchTerm'))
            ->paginate(request('rowsPerPage', 10))
            ->withQueryString()
            ->through(fn ($author) => [
                'id' => $author->id,
                'image_url' => $author->image_url,
                'name' => Str::limit($author->name, 50),
                'email' => $author->email,
                'github_handle' => $author->github_handle,
                'twitter_handle' => $author->twitter_handle,
            ]);

        // return inertia('', [
        //     'authors' => $authors,
        // ]);
    }
}
