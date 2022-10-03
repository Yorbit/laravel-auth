<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Post;
use App\Models\Admin\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    private $validationRules = [
        "title" => "required|min:3|max:150",
        "content" => "required|min:5",
        "post_image" => "image|max:2048",
        "category" => "required|exists:categories,id",
        "tags" => "exists:tags,id",
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::where("user_id", Auth::user()->id)->get();
        $posts = Post::paginate(20);
        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::all();
        return view("admin.posts.create", compact("post", "categories", "tags"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postData = $request->validate($this->validationRules);

        $post = new Post();
        $post->title = $postData["title"];
        $post->user_id = Auth::user()->id;
        $post->content = $postData["content"];
        $post->post_image = Storage::put("uploads/" . Auth::user()->name . "/posts", $request->post_image);
        $post->date = date("Y/m/d H:i:s");
        $post->category_id = $postData["category"];
        
        $post->save();
        if($request->tags) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route("admin.show", $post->id)->with("created", "The post n°" . $post->id . " has been created.");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view("admin.posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view("admin.posts.edit", compact("post", "categories", "tags"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $postData = $request->validate($this->validationRules);

        $post = Post::findOrFail($id);
        $post->title = $postData["title"];
        $post->content = $postData["content"];
        $post->post_image = Storage::put("uploads/" . $post->user->name . "/posts", $request->post_image);
        $post->category_id = $postData["category"];

        $post->save();

        if($request->tags) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->detach();
        }


        return redirect()->route("admin.show", $post->id)->with("updated", "The post n°" . $post->id . " has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect()->route("admin.index")->with("deleted", "The post n°" . $post->id . " has been deleted.");
    }

    public function removeFromCategory($postId) 
    {
        $post = Post::findOrFail($postId);
        $category = $post->category;
        $post->category_id = null;
        $post->save();

        return view("admin.categories.show", compact("category"));
    }
}
