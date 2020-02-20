<?php

namespace App\Http\Controllers;
use \App\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * When click on follow button then action will start from here => post method  apply on route file
     * on user model > following > hasmanyprofile(profile)
     * @param User $user
     * @return mixed
     */
    public function store(User $user)
    {
        return auth()->user()->following()->toggle($user->profile);
    }

}
