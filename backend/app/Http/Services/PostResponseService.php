<?php

namespace App\Http\Services;

use App\Models\PostResponse;
use Illuminate\Http\Request;

class PostResponseService
{
    public function index(Request $request, $postId) {
        return PostResponse::with("user")->where('post_id', $postId)->order($request)->get();
    }

    public function store(Request $request, $postId) {
        $input = $request->except(['file']);
        $postResponse = new PostResponse($input);
        if ($files = $request->file('file')) {

            $file = $request->file->store('public/documents');
 
            $postResponse->image = str_replace("public", "", $file);
        }
    
        $postResponse->user_id = $request->user()->id;
        $postResponse->post_id = $postId;
        
        $postResponse->save();

        return $postResponse;
    }
}