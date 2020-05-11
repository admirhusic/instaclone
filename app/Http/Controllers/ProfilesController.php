<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;
use App\Post;
use Storage;

class ProfilesController extends Controller
{
    public function index($user)
    {

        $follows = (auth()->user() ? auth()->user()->following->contains($user) : false);

        $profile = Profile::where('user_id', $user)->firstOrFail();
        $posts = Post::where('user_id', $user)->latest()->get();


        return view('profile.index', compact('profile', 'posts', 'follows'));
    }


    public function edit($request)
    {

        $profile = Profile::where('user_id', $request)->first();

        $this->authorize('update', $profile);

        return view('profile.edit', compact('profile'));
    }


    public function update(Request $request)
    {

        if ($request->hasFile('image')) {

            // TO DO delete existing profile photo

            $valid_photo = $request->validate([

                'image' => 'image|max:2048'

            ]);

            $image_path = Storage::disk('public')->put(auth()->user()->username, $valid_photo['image']);

            // TO DO resize the uploaded image

            Profile::where('user_id', auth()->user()->id)->update([
                'image_path' => '/storage/' . $image_path,
            ]);
        }



        $request->validate([

            'name' => 'required|max:25',
            'username' => 'required|max:25|unique:users,id,' . auth()->user()->id,
            'url' => 'max:25',
            'bio' => 'max:250',
            'title' => 'max:25'

        ]);


        Profile::where('user_id', auth()->user()->id)->update([
            'url' => $request['url'],
            'bio' => $request['bio'],
            'title' => $request['title']
        ]);


        User::where('id', auth()->user()->id)->update([
            'name' => $request['name'],
            'username' => $request['username'],
        ]);



        return back()->with('success', 'Saved');
    }
}
