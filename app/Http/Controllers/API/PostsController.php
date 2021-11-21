<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostsRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function create_post(PostsRequest $request)
    {
        try {
            if (Post::create($request->validated())) {
                // send all mail in the queue.
                $details = [
                    'website_id' => $request->website_id,
                    'title' => $request->title,
                    'description' => $request->description
                ];
                $job = (new \App\Jobs\SendMailJob($details))
                    ->delay(
                        now()
                        ->addSeconds(2)
                    ); 

                dispatch($job);
                return response()->json([
                    'message' => 'new post created, email sent'
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'an exceptional error occured'
            ], 400);
        } catch (\Error $e) {
            return response()->json([
                'message' => 'an error occured'
            ], 400);
        }
    }
}
