<?php

namespace App\Http\Controllers;

use Inertia\Response;
use App\Models\Author;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Support\Traits\UploadFile;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AuthorValidate;



class AuthorController extends Controller
{
   use UploadFile;

    public function index()
    {
        $authors = Author::orderBy('name')
            ->search(request('searchContext'), request('searchTerm'))
            ->paginate(request('rowsPerPage', 5))
            ->withQueryString()
            ->through(fn ($author) => [
                'id' => $author->id,
                'image_url' => $author->image_url,
                'name' => Str::limit($author->name, 50),
                'email' => $author->email,
                'github_handle' => $author->github_handle,
                'twitter_handle' => $author->twitter_handle,
            ]);
            

            return inertia('BlogAuthor/AuthorIndex', [
                'authors' => $authors,
            ]);
    }
    public function create(): Response
    {
        return inertia('BlogAuthor/AuthorForm');
    }

    public function store(AuthorValidate $request): RedirectResponse
    {
        $authorData = $request->validated();

        if ($request->hasFile('image')) {
            $authorData = array_merge($authorData, $this->uploadFile('image', 'blog', 'originalUUID', 'public'));
        }

        Author::create($authorData);

        return redirect()->route('blogAuthor.index')
            ->with('success', 'Author created.');
    }

    public function edit(int $id): Response
    {
        $author = Author::find($id);

        return inertia('BlogAuthor/AuthorForm', [
            'author' => $author,
        ]);
    }

    public function update(AuthorValidate $request, int $id): RedirectResponse
    {
        $author = Author::findOrFail($id);

        $authorData = $request->validated();

        if ($request->hasFile('image')) {
            $authorData = array_merge($authorData, $this->uploadFile('image', 'blog', 'originalUUID', 'public'));
        } elseif ($request->input('remove_previous_image')) {
            $authorData['image'] = null;
        } else {
            unset($authorData['image']);
        }

        $author->update($authorData);

        return redirect()->route('blogAuthor.index')
            ->with('success', 'Author updated.');
    }

    public function destroy(int $id): RedirectResponse
    {
        Author::findOrFail($id)->delete();

        return redirect()->route('blogAuthor.index')
            ->with('success', 'Author deleted.');
    }
}
