@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <img src="{{$post->image_path}}" alt="" class="image-fluid w-100">
        </div> 
        <div class="col-md-4">
        <div class="card" >
            <div class="card-header">
                <a href="/profile/{{$post->user->id}}">
                    @if (!is_null($post->user->profile->image_path))
                    <img src="{{asset($post->user->profile->image_path)}}" alt="..." class="profile-avatar rounded-circle post-avatar">
                    @else 
                    <img src="{{asset('app-images/profile-photo.png')}}" alt="..." class="profile-avatar rounded-circle post-avatar">
                @endif
                <strong> {{$post->user->username}}</strong>
                </a>
                <a href="" class="float-right"><i class="fas fa-ellipsis-v"></i></a>
            </div>
            <div class="card-body" style="overflow:scroll; max-height:520px; overflow-x: hidden;">
                <a href="/profile/{{$post->user->id}}">
                    @if (!is_null($post->user->profile->image_path))
                    <img src="{{asset($post->user->profile->image_path)}}" alt="..." class="profile-avatar rounded-circle post-avatar">
                    @else 
                    <img src="{{asset('app-images/profile-photo.png')}}" alt="..." class="profile-avatar rounded-circle post-avatar">
                @endif
                <strong> {{$post->user->username}}</strong>
                </a>
                {{$post->caption}}
                <hr />
                    
                @foreach($post->comments->reverse() as $comment)
                <div class="media">
                <div class="media-body">
                     <p class="card-title"> <a class="post-link" href="/profile/USER_ID"> <img src="{{asset('app-images/profile-photo.png')}}" alt="..." class="post-avatar rounded-circle w-4">
                    <strong>{{$comment->user->username}}</strong></a> @if (Auth::user()->can('update', $comment)) <a href="" class="float-right"><i class="fas fa-ellipsis-v"></i></a>@endif
                    <a href="/profile/{{$comment->user->id}}"><strong class="m-0"></strong></a>
                    <br />
                    <p class="ml-4">{{$comment->body}}</p>
                </div>
                </div>
                @endforeach



            </div>
            <div class="card-footer bg-transparent">
                <a href="#" class="mr-2"> <i class="far fa-heart fa-lg"></i></a>
                <a href="#" class="mr-2"> <i class="far fa-comment fa-lg"></i></i></a>
                <a href="#" class="mr-2"> <i class="far fa-paper-plane fa-lg"></i></i></a>
                <a href="#" class="float-right"> <i class="far fa-bookmark fa-lg"></i></a>
                <p class="mt-2 mb-0"><strong>{{$post->likers->count()}} likes</strong></p>
            </div>
            <div class="card-footer">
                <form method="POST" action="/comment/{{$post->id}}">
                    <input type="hidden"  value="{{$post->id}}" name="post_id">
                    <div class="input-group mb-3">
                            @csrf
                        <input type="text" class="form-control" placeholder="Add a comment..." aria-label="Post"
                            aria-describedby="basic-addon2" name="comment">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary float-right">Post</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>   
    </div>
</div>
@endsection