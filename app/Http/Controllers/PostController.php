<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PostController extends Controller
{

    public function index()
    {
        if (Auth::user()->is_admin) {
            $posts = Post::with('image')->get();
        } else {
            $posts = Post::with('image')->where('user_id', auth()->id())->get();
        }
        // dd(Image::all()->toarray(), $posts->toarray());
        return view('post-index', compact('posts'));
    }
    
    public function create()
    {
        return view('post-form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
        ]);

        $post = Post::create([
            'title'       => $request->title,
            'description' => $request->description,
            'user_id'     => auth()->id(),
            'date'        => now(),
        ]);

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = Str::random(20) . '.' . $imageFile->getClientOriginalExtension(); 
            $imagePath = $imageFile->storeAs('images', $imageName, 'public'); 

            $image = Image::create([
                'image_name' => $imageName, // Save the new filename
                'image_path' => $imagePath,
            ]);

            $post->image_id = $image->id;
            $post->save();
        }
        
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }
}
