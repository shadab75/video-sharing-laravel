@extends('layouts.panel')
@section('content')

    @foreach($notifications as $notification)
      {{$notification->data['description']}}.<br>
    @endforeach

@endsection
