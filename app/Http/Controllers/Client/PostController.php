<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Auth;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index()
    {
        if(Auth::user())
        {
            $posts = Post::orderBy('created_at','DESC')->get();
            return view('client.post.index',compact('posts'));
        }else{
            return redirect()->route('login-client');
        }
        
    }

    public function show($slug)
    {
        $post = Post::where('slug',$slug)->first();
        $random_post = Post::whereNotIn('slug',[$slug])->inRandomOrder()->limit(3)->get();
        $post->view = $post->view + 1;
        $post->save();

        return view('client.post.detail',[
            'post' => $post,
            'random_post' => $random_post,
        ]);
    }

    public function create()
    {
        $tags = Tag::where('status',1)->get();
        return view('client.post.create',compact('tags'));
    }

    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->get('title');
        $post->slug = Str::slug($post->title);
        $post->content = $request->get('content');
        $post->name_user = Auth::user()->name;
        if(Auth::user()->avatar != null)
        {
            $post->avatar_user = Auth::user()->avatar;
        }else{
            $post->avatar_user = Auth::user()->avatar_url;
        }

        $file = $request->file('image'); 

        if($request->hasFile('image'))
        {
           
            $name = $file->getClientOriginalName();
            $path = Storage::disk('public')    //->Lưu vào trong thư mục public
                    ->putFileAs('avtar-post-client', $file, $name); 

            $post->path = 'public';
            $post->image = $path;
        }

        $post->save();

        $tag = $request->get('tag');
        foreach($tag as $value)
        {
            $post->tags()->attach($value);
        }

        return redirect()->route('post-client.index');
    }

    public function likes(Request $request)
    {
        $data = $request->all();

        $user = Auth::user();
        $post = Post::find($data['post']);

        $get = $user->votePosts()->where('post_id',$data['post'])->first();

        if($get)
        {
            $user->votePosts()->detach($post->id);
        }else{
           $user->votePosts()->attach($post->id);
        }

        return response()->json(['status' => 1, 'count_like' => $post->voteUsers()->count(), 'code' => 200], 200);
    }

    public function postTag($id)
    {
        $tag = Tag::where('id',$id)->first();

        return view('client.post.post_by_tag',compact('tag'));
    }
}
