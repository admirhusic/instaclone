@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <h3>Edit profile </h3>
                <div class="container text-center mb-3">
                    @if (!is_null($profile->image_path))
                    <img src="{{asset($profile->image_path)}}" alt="..." class="profile-avatar rounded-circle">
                    @else 
                    <img src="{{asset('app-images/profile-photo.png')}}" alt="..." class="profile-avatar rounded-circle">
                   @endif
                </div>


            <form method="POST" action="/profile/{{$profile->user->id}}/update" enctype="multipart/form-data">
                    @csrf
                 <div class="form-group row">
                  <label for="exampleFormControlFile1 " class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-8 offset-2">
                  <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
                  </div>
                 </div>       
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label"><strong>name</strong></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="name" name="name" value="{{old('name') ?? $profile->user->name}}">
                      @error('name')
                       <div class="invalid-feedback">
                        {{$message}}
                        </div>
                      @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label"><strong>username</strong></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control  @error('username') is-invalid @enderror" id="username" placeholder="username" name="username" value="{{old('username') ?? $profile->user->username}}">
                         @error('username')
                       <div class="invalid-feedback">
                        {{$message}}
                        </div>
                      @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="url" class="col-sm-2 col-form-label"><strong>url</strong></label>
                    <div class="col-sm-10">

                            <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend2">http://</span>
                            </div>
                        <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" placeholder="url" name="url" value="{{old('url') ?? $profile->url}}">
                            @error('username')
                            <div class="invalid-feedback">
                                {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label"><strong>title</strong></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control  @error('title') is-invalid @enderror" id="title" placeholder="title" name="title" value="{{old('title') ?? $profile->title}}">
                         @error('title')
                            <div class="invalid-feedback">
                                {{$message}}
                                </div>
                            @enderror
                    </div>
                </div>




                <div class="form-group row">
                    <label for="url" class="col-sm-2 col-form-label"><strong>bio</strong></label>
                    <div class="col-sm-10">
                       <textarea class="form-control  @error('title') is-invalid @enderror" name="bio">{{old('bio') ?? $profile->bio}}</textarea>
                        @error('bio')
                            <div class="invalid-feedback">
                                {{$message}}
                                </div>
                            @enderror
                    </div>
                </div>

                <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </div>
            </form>
             @if ($message = Session::get('success'))
            <div class="alert alert-dark alert-block align-self-baseline">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
            </div>
            @endif
            

            {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
        </div>
    </div>
   

</div>

@endsection