@extends('layouts.panel')
@section('content')
    {{$video->title}}
    <br>
    {{$video->description}}
    <video src="{{asset('/storage/' . $video->id . '.mp4')}}" width="300"></video>
@endsection
