

@extends('layouts.app')



@section('content')

<!-- Content -->
    <div class="container profile">
        
        <div class="row border-bottom">
            {{-- Profile photo wrapper --}}
            <div class="col-3 text-center">
            {{-- MD --}}
            <div class="d-none d-md-block d-lg-none">
            @if (!is_null($profile->image_path))
            <img src="{{asset($profile->image_path)}}" alt="..." class="profile-avatar rounded-circle">
            @else 
            <img src="{{asset('app-images/profile-photo.png')}}" alt="..." class="profile-avatar rounded-circle">
           @endif
            </div>
            
           {{-- Mobile --}}
           <div class="d-block d-sm-none d-none d-sm-block d-md-none">
           @if (!is_null($profile->image_path))
           <img src="{{asset($profile->image_path)}}" alt="..." class="profile-avatar-mobile rounded-circle">
           @else 
           <img src="{{asset('app-images/profile-photo.png')}}" alt="..." class="profile-avatar-mobile rounded-circle">
          @endif
          </div>
        </div>
        {{-- End Profile photo wrapper --}}
        {{-- User name and options wrapper --}}
        <div class="col-9 ">
         <div class="row">
             <div class="col">
                 <h4 class="h4">{{$profile->user->username}}</h4>
             </div>
             <div class="col d-none d-md-block d-lg-none">
                @can('update', $profile)
                <a class="btn btn-outline-secondary" href="/profile/{{auth()->user()->id}}/edit" role="button">Edit</a>
                @endcan 
             </div>

             <div class="col">

                @cannot('update', $profile) 
                
                <follow-button user-id="{{$profile->user_id}}" follows="{{$follows}}"></follow-button>
              
                 @endcannot



                @can('update', $profile)

                <a href="#" data-toggle="modal" data-target="#profile-modal"><i class="fas fa-cog fa-2x"></i></a> 
                
                @endcan 
                
             </div>
             {{-- <div class="col">
                <button data-toggle="modal" data-target="#upload-modal" class="btn btn-primary float-right"><i class="fas fa-camera"></i></button>
             </div> --}}
         </div>
         <div class="row d-block d-sm-none d-none d-sm-block d-md-none">
             <div class="col">
                @can('update', $profile)
                
                <a class="btn btn-outline-secondary btn-block" href="/profile/{{auth()->user()->id}}/edit" role="button">Edit</a>
                
                @endcan 
             </div>
         </div>
         <div class="row text-center pt-3 d-none d-md-flex">
            <div class="col">
                <p><strong>{{count($profile->user->post)}}</strong> <br/> posts</p>
            </div>
            <div class="col">
               <p><strong>{{count($profile->followers)}}</strong> <br/> followers</p>
            </div>
            <div class="col">
               <p> <strong>{{count($profile->user->following)}}</strong>  <br/>following</p>
            </div>
         </div>
         <div class="row">
             <div class="col">
                <p class="m-0"><strong>{{$profile->user->name}}</strong></p>
                <p class="m-0">{{$profile->title}}</p>
                <p class="m-0">{{$profile->bio}}</p>
                <p class="m-0"><a class="profile url" target="_blank" href="http://{{$profile->url}}">{{$profile->url}}</a></p>
             </div>
         </div>
        
        </div>
         {{-- User name and options wrapper --}}
        </div>
        <div class="row d-flex d-sm-none d-none d-sm-flex d-md-none text-center border-bottom pt-2">
            <div class="col">
                <p><strong>{{count($profile->user->post)}}</strong> <br/> posts</p>
            </div>
            <div class="col">
               <p><strong>{{count($profile->followers)}}</strong> <br/> followers</p>
            </div>
            <div class="col">
               <p> <strong>{{count($profile->user->following)}}</strong>  <br/>following</p>
            </div>
         </div>
        </div> 

        <div class="container pt-3">
            <div class="row">
                @foreach($posts as $post)
                <div class="col mb-5">
                <a href="/p/{{$post->id}}"  >
                <img src="{{asset($post->image_path)}}" alt="" class="w-100 image-fluid">
                <div class="overlay">
                <p class="overlay-text text-center">  <i class="fas fa-heart"></i> {{$post->likers->count()}}</p>
                <p class="overlay-text text-center"><i class="fas fa-comment"></i> {{$post->comments->count()}}</p>
                </div>
                </a>
                </div>
                @endforeach
                </div>      
        </div>

                   
    <!-- Content end -->

    @include('profile.modal_edit_profile')
    @include('profile.modal_upload_post')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection