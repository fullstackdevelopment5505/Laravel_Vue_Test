<?php

namespace App\Http\Services;

use App\Models\Post;
use Illuminate\Http\Request;

class PostService
{
    public function index(Request $request) {
        return Post::with("user")->searchFilter($request)->order($request)->paginate(10);
    }

    public function store(Request $request) {
        $input = $request->except(['file']);
        $post = new Post($input);
        if ($files = $request->file('file')) {

            $file = $request->file->store('public/documents');
 
            $post->image = str_replace("public", "",$file);
  
        }
        
        $post->user_id = $request->user()->id;
        $post->save();

        return $post;
    }
}