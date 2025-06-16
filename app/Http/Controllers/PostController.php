<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreatRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::orderBy('created_at', 'DESC')->paginate(5);
        return view('post.index', compact('categories', 'posts'));
    }

    private function createUniqueSlug($title, $id = null)
    {
        $slug = Str::slug($title);
        $count = 0;
        $originalSlug = $slug;

        // Check if slug exists
        while (Post::where('slug', $slug)->when($id, function ($query) use ($id) {
            return $query->where('id', '!=', $id);
        })->exists()) {
            $count++;
            $slug = $originalSlug . '-' . $count;
        }

        return $slug;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('post.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreatRequest $request)
    {

        $data = $request->validated();

        $image = $data['image'];
        unset($data['image']);

        $data['slug'] = $this->createUniqueSlug($data['title']);

        $imagePath = $image->store('posts', 'public');
        $data['image'] = $imagePath;

        $data['user_id'] = Auth::id();
        Post::create($data);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, Post $post)
    {
        return view('post.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

        $categories = Category::get();

        return view('post.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {

        $data = $request->validated();

        // If title changed, update the slug
        if ($post->title !== $data['title']) {
            $data['slug'] = $this->createUniqueSlug($data['title'], $post->id);
        }

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $data['image'] = $imagePath;

        }

        $post->update($data);

        return redirect()->route('post.show', ['username' => $post->user->username, 'post' => $post->slug])
            ->with('success', 'Post updated successfully!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('dashboard');
    }

    public function category(Category $category)
    {

        $posts = $category->posts()->simplePaginate(5);

        $categories = Category::all();

        return view('post.index', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }
}
