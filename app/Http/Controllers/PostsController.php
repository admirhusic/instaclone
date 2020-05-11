<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Post;
use Storage;

class PostsController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index()
    {   
        

        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->latest()->paginate(10);
        
        return view('post.index', compact('posts', 'users'));
    }




    public function show($request)
    {

        $post = Post::where('id', $request)->first();


        return view('post.show', compact('post'));
    }








    public function store(Request $request)
    {

        $data =  $request->validate([
            'photo' => 'required|image', // TODO add max filesize
            'caption' => 'max:255'

        ]);

        //TO DO


        // rename the file



        // save the file to storage
        $image_path = Storage::disk('public')->put(auth()->user()->username, $data['photo']);


        // resize the image
        $resized_image = Image::make(public_path("storage/{$image_path}"))->fit(1800);
        $resized_image->save();


        // save all data to database
        $post =  Post::create([
            'user_id' => auth()->user()->id,
            'image_path' => '/storage/' . $image_path,
            'caption' => $data['caption'],
        ]);

        return back();
    }
}
