<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; 

use Illuminate\Support\Facades\Auth;  
use Illuminate\Support\Facades\Mail;  
use App\Mail\CreatePostMail;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // salvo info utente loggato che sta generando il post
        $user = Auth::user();

        //dd($data)

        $post = new Post();

        // esiste dentro $data una key image?
        if(array_key_exists('image', $data)){
            // post_images: cartella che si genererà dentro public
            $image_url = Storage::put('post_images', $data['image']);
            // gli dico: sostituisci tutta la parte di array $data['image'] con il dato $image_url
            $data['image'] = $image_url;
        }

        $post->fill($data);
        $post->slug = Str::slug($post->title, '-');
        $post->save();

        if( array_key_exists('tags', $data) ) $post->tags()->attach($data['tags']);

        //invio mail
        $mail = new CreatePostMail($post);
        Mail::to($user->mail)->send($mail);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //$categories = Category::all();
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        $post_tags_id = $post->tags->pluck('id')->toArray();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();

        $post['slug'] = Str::slug($request->title, '-');

        if(array_key_exists('image', $data)){

            if($post->image) Storage::delete($post->image);

            $image_url = Storage::put('post_images', $data['image']);
            $data['image'] = $image_url;
        }

        $post->update($data);

        if( !array_key_exists('tags', $data) ) $post->tags()->detach(); else $post->tags()->sync($data['tags']);

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('message', "il post $post->title è stato eliminato");
    }
}
