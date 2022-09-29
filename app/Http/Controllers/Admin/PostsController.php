<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Post;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Category;

class PostsController extends Controller
{

    private $validationRules = [
        "title" => "required|min:3|max:150",
        "content" => "required|min:5|max:255",
        "post_image_url" => "active_url",
        "category" => "required|exists:categories,id"
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
        $posts = Post::where("user_id", Auth::user()->id)->get();
        return view("admin.index", compact("posts"));
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
        return view("admin.create", compact("post"), compact("categories"));
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
        $post->user = Auth::user()->id;
        $post->title = $postData["title"];
        $post->content = $postData["content"];
        $post->post_image_url = $postData["post_image_url"];
        $post->date = date("Y/m/d H:i:s");
        $post->category_id = $postData["category"];
        $post->save();

        return redirect()->route("admin.show", $post->id)->with("created", $post->id);
        
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
        return view("admin.show", compact("post"));
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
        return view("admin.edit", compact("post"), compact("categories"));
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
        $post->post_image_url = $postData["post_image_url"];
        $post->category_id = $postData["category"];
        $post->save();

        return redirect()->route("admin.show", $post->id)->with("updated", $post->id);
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

        return redirect()->route("admin.index")->with("deleted", $post->id);
    }
}
