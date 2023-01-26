<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\PostResponseService;

class PostResponseController extends Controller
{
    private PostResponseService $postResponseService;
    //
    public function __construct(PostResponseService $postResponseService)
    {
        $this->postResponseService = $postResponseService;
    }

    public function index(Request $request, $id)
    {
        $response = $this->postResponseService->index($request,$id);
        return new JsonResource($response);
    }


    public function store(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'description' => 'required',
        ]);
        
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ], 422);
        }

        $response = $this->postResponseService->store($request, $id);

        return (new JsonResource($response))->additional(['message' => __('messages.store', ['name' => 'PostResponse'])]);
    }

    
}
