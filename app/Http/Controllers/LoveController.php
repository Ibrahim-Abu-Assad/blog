<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class LoveController extends Controller
{

    public function love(Post $post) {

        $hasLoved = auth()->user()->hasLoved($post);

        if($hasLoved){
            $post->loves()->where('user_id', auth()->id())->delete();

            return response()->json([
            'lovesCount' => $post -> loves() -> count()
            ]);

        }else{
            $post->loves()->create([
            'user_id' => auth()->id(),
            ]);
        }



        return response()->json([
            'lovesCount' => $post -> loves() -> count()
        ]);
    }
}
