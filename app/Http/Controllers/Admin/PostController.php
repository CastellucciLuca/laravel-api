<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    protected $validationRules = [
        'title' => ['required', 'unique:posts' ],
        'post_date' => 'required',
        'content' => 'required',
        'image' => 'required|image|max:300',
        'type_id' => 'required|exists:types,id',
        "technologies" => "required|array|exists:technologies,id",
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(30);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create', ["post"=>new Post(),"typesList" => Type::all(),"technologyList" => Technology::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->validationRules);
        $data['author'] = Auth::user()->name;
        $data['slug'] = Str::slug($data['title']);
        $data['image'] =  Storage::put('imgs/', $data['image']);
        $newPost = new Post();
        $newPost->fill($data);
        $newPost->save();
        $newPost->technologies()->sync($data['technologies']);
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
        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post' => $post , 'typesList' => Type::all(),"technologyList" => Technology::all()]);
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
        $data = $request->validate([
            'title' => ['required', Rule::unique('posts')->ignore($post->id) ],
            'post_date' => 'required',
            'content' => 'required',
            'image' => 'image|required|max:300',
            'type_id' => 'required|exists:types,id',
            "tecnologies" => "required|array|exists:technologies,id"
        ]);
        if ($request->hasFile('image')){
            if (!$post->isImageAUrl()){
                Storage::delete($post->image);
            }
            $data['image'] =  Storage::put('imgs/', $data['image']);
        }
        $post->update($data);
        if (isset($data['technologies'])){
            $post->technologies()->sync($data['technologies']);
        }
        return redirect()->route('admin.posts.show', compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (!$post->isImageAUrl()) {
            Storage::delete($post->image);
        }
        $post->delete();
        return redirect()->route('admin.posts.index')->with('message', 'The post has been removed correctly')->with('message_class','danger');
    }
}
