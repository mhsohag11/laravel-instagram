<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{



    public function index (User $user)
    {
        $followingStatus = auth()->user() ? auth()->user()->following->contains($user->id) : false;
        return view('profiles.index' , compact('user', 'followingStatus'));
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
