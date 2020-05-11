@extends('layouts.app')



@section('content')

<div>
 <!-- Content -->
    <div class="container mt-5 posts">
    <posts-component :user-id={{Auth::user()->id}}></posts-component>
    </div>
@endsection