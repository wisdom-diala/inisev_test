<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscribersRequest;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
    public function subscribe(SubscribersRequest $request)
    {
        try {
            $subscriber = Subscriber::where([
                                'website_id' => $request->website_id, 
                                'email' => $request->email])
                        ->count();
            if ($subscriber <= 0) {
                if (Subscriber::create($request->validated())) {
                    return response()->json([
                        'message' => 'subscribed'
                    ], 200);
                }else{
                    return response()->json([
                        'message' => 'unable to subscribe this user'
                    ]);
                }
            }else{
                return response()->json([
                    'message' => 'user already subscribed to this website'
                ], 200);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        } catch (\Error $e){
            return response()->json([
                'message' => "An error occured"
            ], 400);
        }
    }
}
