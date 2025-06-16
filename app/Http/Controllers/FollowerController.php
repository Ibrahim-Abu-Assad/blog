<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\json;

class FollowerController extends Controller
{
    public function followUnfollow(User $user) {
        $user->followers()->toggle(auth()->user());
        // auth()->user()->following()->toggle($user->id);

        return response()->json([
            'followersCount' => $user->followers()->count()
        ]);
    }
}
