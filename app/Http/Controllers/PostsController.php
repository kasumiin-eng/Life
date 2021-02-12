<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class PostsController extends Controller
{
    /**
     * (Display a listing of the resource.)
     *Create a new controller instance
     * (@return \Illuminate\Http\Response)
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
 
    }

    public function index()
    {
        $posts = Post::all();
        return view('posts.index')->with('posts',$posts);

        
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);
 
        $post = new Post;
        $post->user_id = auth()->user()->id;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post -> category = $request->input('category');
        $post -> image = $request->file('image')->store('image','public');
        $post->save();
    
        

        return redirect(route('posts.index'))->with('success', 'Done');

    }
/*postsaveを切り取ったら投稿できるということはテーブルに保存できる状態じゃないということか
これはテーブルがいけないのか。。？？
タイムスタンプを無効にするべきだそう*/ 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
 
        if (auth()->user()->id != $post->user_id) {
            return redirect(route('posts.index'))->with('error', '許可されていない操作です');
        }
        return view('posts.edit')->with('post', $post);
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
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);
 
        $post = Post::find($id);
        if (auth()->user()->id != $post->user_id) {
            return redirect(route('posts.index'))->with('error', '許可されていない操作です');
        }
 
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();
 
        return redirect(route('posts.index'))->with('success', 'ブログ記事を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (auth()->user()->id != $post->user_id) {
            return redirect(route('posts.index'))->with('error', '許可されていない操作です');
        }
 
        $post->delete();
        return redirect(route('posts.index'))->with('success', 'ブログ記事を削除しました');

    }
}
