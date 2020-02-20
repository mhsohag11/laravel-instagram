<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * caching user all count status value
     * following status => pass this value index page => true/false => follow/unfollow
     * profile index page
     */

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

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * Profile edit page => only authorized user can do this => for checking this used laravel Policy functionality
     */
    public function edit(User $user){
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    /**
     * When click Profile update button => post method apply on routing page
     * Policy method apply => only authorized user and own of this profile can do update action
     * requested all input field check validation
     * image will be stored
     * then image will be cropped by a third party library
     * after complete all update acton redirect to current profile page
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
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
