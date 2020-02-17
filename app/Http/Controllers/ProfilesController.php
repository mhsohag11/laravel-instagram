<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{



    public function index (User $user)
    {


        $user = Cache::remember('count.user.'.$user->id, now()->addMinutes(2), function () use ($user) {
            return $user;
        });

        $followersCount = Cache::remember('count.followers.'.$user->id, now()->addSecond(30), function () use ($user) {
            return $user->profile->followers->count();
        });

        $followingCount = Cache::remember('count.following.'.$user->id, now()->addSecond(30), function () use ($user) {
            return $user->following->count();
        });

        $postsCount = Cache::remember('count.posts.'.$user->id, now()->addSecond(30), function () use ($user) {
            return $user->posts->count();
        });
        $followingStatus = auth()->user() ? auth()->user()->following->contains($user->id) : false;

        return view('profiles.index' , compact('user', 'followersCount', 'followingCount', 'postsCount', 'followingStatus'));
    }

    public function edit(User $user){
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image'   => ['image']
        ]);

        if (request('image'))
        {
            $imagePath = request('image')->store('users','public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(150, 150);
            $image->save();
            auth()->user()->profile->update(array_merge(
                $data,
                ['image' => $imagePath]
            ));
        } else {
            auth()->user()->profile->update($data);
        }



        return redirect("/profile/{$user->id}");
    }
}
